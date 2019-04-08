<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int $order_id
 * @property int $item_id
 * @property int $size_id
 * @property int $quantity
 * @property double $price
 * @property string $created
 * @property string $updated
 * @property int $status_id
 *
 * @property Order $order
 * @property Item $item
 * @property Size $size
 * @property OrderItemStatus $status
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id', 'price'], 'required'],
            [['order_id', 'item_id', 'size_id', 'quantity', 'status_id'], 'integer'],
            [['price'], 'number'],
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
            'order_id' => Yii::t('app', 'Order ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'size_id' => Yii::t('app', 'Size ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'status_id' => Yii::t('app', 'Status ID'),
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    public function getSize()
    {
        return $this->hasOne(Size::class, ['id' => 'size_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(OrderItemStatus::class, ['id' => 'status_id']);
    }
}
