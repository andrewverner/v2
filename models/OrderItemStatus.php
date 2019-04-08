<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_item_status".
 *
 * @property int $id
 * @property string $title
 * @property int $type
 * @property string $created
 * @property string $updated
 */
class OrderItemStatus extends \yii\db\ActiveRecord
{
    const TYPE_POSITIVE = 1;
    const TYPE_NEGATIVE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['type'], 'integer'],
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
            'type' => Yii::t('app', 'Type'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function isPositive()
    {
        return $this->type == self::TYPE_POSITIVE;
    }
}
