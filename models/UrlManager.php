<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "url_manager".
 *
 * @property int $id
 * @property string $pattern
 * @property string $route
 * @property int $active
 * @property string $created
 * @property string $updated
 */
class UrlManager extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url_manager';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pattern', 'route'], 'required'],
            [['active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['pattern', 'route'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pattern' => Yii::t('app', 'Pattern'),
            'route' => Yii::t('app', 'Route'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
