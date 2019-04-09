<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_status_flow".
 *
 * @property int $id
 * @property int $from_id
 * @property int $to_id
 * @property int $direction
 * @property int $active
 * @property string $created
 * @property string $updated
 *
 * @property OrderStatus $status
 */
class OrderStatusFlow extends \yii\db\ActiveRecord
{
    const DIRECTION_NEXT = 1;
    const DIRECTION_PREV = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_status_flow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_id', 'to_id'], 'required'],
            [['from_id', 'to_id', 'direction', 'active'], 'integer'],
            [['created', 'updated', 'active'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_id' => Yii::t('app', 'From ID'),
            'to_id' => Yii::t('app', 'To ID'),
            'direction' => Yii::t('app', 'Direction'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'to_id']);
    }
}
