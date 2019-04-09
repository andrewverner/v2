<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_status".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $is_final
 * @property string $color
 * @property string $created
 * @property string $updated
 *
 * @property OrderStatusFlow[] $nextStatuses
 * @property OrderStatusFlow[] $prevStatuses
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['is_final'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title', 'color'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
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
            'is_final' => Yii::t('app', 'Is Final'),
            'color' => Yii::t('app', 'Color'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getNextStatuses()
    {
        return $this->hasMany(OrderStatusFlow::class, ['from_id' => 'id'])->where([
            'direction' => OrderStatusFlow::DIRECTION_NEXT,
            'active' => 1,
        ]);
    }

    public function getPrevStatuses()
    {
        return $this->hasMany(OrderStatusFlow::class, ['from_id' => 'id'])->where([
            'direction' => OrderStatusFlow::DIRECTION_PREV,
            'active' => 1,
        ]);
    }

    public function afterDelete()
    {
        OrderStatusFlow::deleteAll(['from_id' => $this->id]);
        OrderStatusFlow::deleteAll(['to_id' => $this->id]);
    }
}
