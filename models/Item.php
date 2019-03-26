<?php

namespace app\models;

use app\components\behaviors\SeoBehavior;
use app\modules\panel\models\Notification;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $price
 * @property int $published
 * @property string $created
 * @property string $updated
 *
 * @property ItemCategory[] $categoryRels
 * @property ItemSize[] $sizeRels
 * @property ItemImage[] $imageRels
 * @property ItemPropertyValueRel[] $propertyRels
 * @property Seo $seo
 * @property ItemReserve[] $reserves
 * @property OrderItem[] $orderItems
 */
class Item extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SeoBehavior::className(),
                'model' => $this,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['description'], 'string'],
            [['price', 'published'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'published' => Yii::t('app', 'Published'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return ItemCategory[]|null
     */
    public function getCategoryRels()
    {
        return $this->hasMany(ItemCategory::className(), ['item_id' => 'id']);
    }

    /**
     * Append item to category
     *
     * @param Category $category
     * @return bool
     */
    public function addToCategory(Category $category)
    {
        $rel = $this->getCategoryRel($category->id);
        if ($rel) {
            return false;
        }

        $rel = new ItemCategory();
        $rel->item_id = $this->id;
        $rel->category_id = $category->id;

        return $rel->save();
    }

    /**
     * @param $categoryId
     * @return ItemCategory|null
     */
    public function getCategoryRel($categoryId)
    {
        return ItemCategory::findOne(['item_id' => $this->id, 'category_id' => $categoryId]);
    }

    /**
     * @return Size[]|null
     */
    public function getSizeRels()
    {
        return $this->hasMany(ItemSize::className(), ['item_id' => 'id']);
    }

    /**
     * @param Size $size
     * @return bool
     */
    public function addSize(Size $size)
    {
        $rel = $this->getSizeRel($size->id);
        if ($rel) {
            return false;
        }

        $rel = new ItemSize();
        $rel->item_id = $this->id;
        $rel->size_id = $size->id;

        return $rel->save();
    }

    public function getSizeRel($sizeId)
    {
        return ItemSize::findOne(['item_id' => $this->id, 'size_id' => $sizeId]);
    }

    public function getImageRels()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id']);
    }

    public function getPropertyRels()
    {
        return $this->hasMany(ItemPropertyValueRel::class, ['item_id' => 'id'])
            ->innerJoinWith(['propertyValue'])
            ->innerJoin(ItemProperty::tableName() . ' ip', 'ip.id = item_property_value.property_id')
            ->orderBy(['ip.title' => SORT_ASC, 'item_property_value.value' => SORT_ASC]);
    }

    public function getReserves()
    {
        return $this->hasMany(ItemReserve::class, ['item_id' => 'id']);
    }

    public function isSoldOut()
    {
        $totalQuantity = 0;
        foreach ($this->reserves as $reserve) {
            $totalQuantity += $reserve->quantity;
        }

        return (bool) $totalQuantity;
    }

    public function beforeDelete()
    {
        if ($seo = $this->seo) {
            $seo->delete();
        }

        return parent::beforeDelete();
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['item_id' => 'id']);
    }

    public function decreaseQuantity($quantity)
    {
        while ($quantity > 0) {
            /**
             * @var ItemReserve $reserve
             */
            $reserve = ItemReserve::find()
                ->where(['item_id' => $this->id])
                ->andWhere('quantity > 0')
                ->one();

            if ($reserve) {
                if ($reserve->quantity >= $quantity) {
                    $reserve->quantity -= $quantity;
                    $reserve->save();
                    $quantity = 0;
                } else {
                    $quantity -= $reserve->quantity;
                    $reserve->quantity = 0;
                    $reserve->save();
                }
            } else {
                Notification::add(
                    'We are run out of item "{title}", {quantity} needed',
                    ['title' => $this->title, 'quantity' => $quantity],
                    Notification::TYPE_WARNING
                );
                break;
            }
        }
    }
}
