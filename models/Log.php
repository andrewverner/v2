<?php

namespace app\models;

use app\components\LogBehavior;
use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property string $entity
 * @property string $event_type
 * @property int $user_id
 * @property string $old_attributes
 * @property string $new_attributes
 * @property string $datetime
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['datetime'], 'safe'],
            [['entity', 'event_type'], 'string', 'max' => 45],
            [['old_attributes', 'new_attributes'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entity' => Yii::t('app', 'Entity'),
            'event_type' => Yii::t('app', 'Event Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'old_attributes' => Yii::t('app', 'Old Attributes'),
            'new_attributes' => Yii::t('app', 'New Attributes'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }
}
