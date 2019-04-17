<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $address_id
 * @property string $contact_name
 * @property string $email
 * @property string $phone
 * @property int $delivery_type
 * @property int $pickup_point_id
 * @property int $status_id
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 * @property UserAddress $address
 * @property OrderItem[] $items
 * @property OrderDeliveryInfo $deliveryInfo
 * @property OrderStatus $status
 * @property OrderStatusLog[] $statusLog
 * @property OrderStatusLog $lastStatusLog
 * @property DeliveryType $deliveryType
 * @property PickupPoint $pickupPoint
 *
 * @property float $price
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address_id', 'delivery_type', 'status_id', 'pickup_point_id'], 'integer'],
            [['contact_name', 'email', 'phone'], 'required'],
            [['created', 'updated'], 'safe'],
            [['contact_name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'delivery_type' => Yii::t('app', 'Delivery Type'),
            'pickup_point_id' => Yii::t('app', 'Pickup Point ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getAddress()
    {
        return $this->hasOne(UserAddress::class, ['id' => 'address_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'status_id']);
    }

    public function getDeliveryInfo()
    {
        return $this->hasOne(OrderDeliveryInfo::class, ['order_id' => 'id']);
    }

    public function getDeliveryType()
    {
        return $this->hasOne(DeliveryType::class, ['id' => 'delivery_type']);
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    public function getPrice()
    {
        return array_reduce($this->items, function ($carry, $item) {
            /**
             * @var OrderItem $item
             */

            if ($item->status->isPositive()) {
                return $carry += $item->price * $item->quantity;
            }

            return $carry;
        });
    }

    public function getStatusLog()
    {
        return $this->hasMany(OrderStatusLog::class, ['order_id' => 'id']);
    }

    public function getLastStatusLog()
    {
        return OrderStatusLog::find()
            ->where([
                'order_id' => $this->id,
                'status_id' => $this->status_id,
            ])
            ->orderBy(['datetime' => SORT_DESC])
            ->limit(1)
            ->one();
    }

    public function getPickupPoint()
    {
        return $this->hasOne(PickupPoint::class, ['id' => 'pickup_point_id']);
    }
}
