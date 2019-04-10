<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_status_log".
 *
 * @property int $id
 * @property int $order_id
 * @property int $status_id
 * @property string $datetime
 *
 * @property Order $order
 * @property OrderStatus $status
 */
class OrderStatusLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_status_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'status_id'], 'required'],
            [['order_id', 'status_id'], 'integer'],
            [['datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'status_id' => 'Status ID',
            'datetime' => 'Datetime',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'status_id']);
    }

    public static function create(Order $order, OrderStatus $orderStatus)
    {
        $model = new self();
        $model->order_id = $order->id;
        $model->status_id = $orderStatus->id;
        $model->save();
    }
}
