<?php

namespace app\models;

use app\components\LogBehavior;
use Yii;

/**
 * This is the model class for table "size".
 *
 * @property int $id
 * @property string $value
 * @property string $created
 */
class Size extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            LogBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['value'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
}
