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
 * @property int $status
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 * @property UserAddress $address
 * @property OrderItem[] $items
 * @property OrderDeliveryInfo $deliveryInfo
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
            [['user_id', 'address_id', 'delivery_type', 'status'], 'integer'],
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
            'status' => Yii::t('app', 'Status'),
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

    public function getDeliveryInfo()
    {
        return $this->hasOne(OrderDeliveryInfo::class, ['order_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }
}
