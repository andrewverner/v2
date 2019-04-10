<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_reserve".
 *
 * @property int $id
 * @property int $item_id
 * @property int $store_id
 * @property int $size_id
 * @property int $quantity
 * @property string $created
 * @property string $updated
 *
 * @property Item $item
 * @property Store $store
 * @property ItemSize $sizeRel
 */
class ItemReserve extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_reserve';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'store_id'], 'required'],
            [['item_id', 'store_id', 'quantity', 'size_id'], 'integer'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'size_id' => Yii::t('app', 'Size ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    public function getStore()
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }

    public function getSizeRel()
    {
        return $this->hasOne(ItemSize::class, ['size_id' => 'size_id']);
    }
}
