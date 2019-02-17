<?php

namespace app\models;

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

    public function getCategoryRels()
    {
        return $this->hasMany(ItemCategory::className(), ['item_id' => 'id']);
    }

    /**
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

    public function getSizeRels()
    {
        return $this->hasMany(ItemSize::className(), ['item_id' => 'id']);
    }

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
}
