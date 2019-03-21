<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property int $active
 * @property string $created
 * @property string $updated
 * @property int $is_external
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['code'], 'string'],
            [['active', 'is_external'], 'integer'],
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
            'code' => Yii::t('app', 'Code'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'is_external' => Yii::t('app', 'Is External'),
        ];
    }
}
