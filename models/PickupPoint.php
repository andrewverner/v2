<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pickup_point".
 *
 * @property int $id
 * @property string $address
 * @property double $geo_lat
 * @property double $geo_lng
 * @property string $work_time
 * @property string $phone
 * @property int $active
 * @property string $created
 * @property string $updated
 */
class PickupPoint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pickup_point';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['geo_lat', 'geo_lng'], 'number'],
            [['active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['address', 'work_time', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'geo_lat' => Yii::t('app', 'Geo Lat'),
            'geo_lng' => Yii::t('app', 'Geo Lng'),
            'work_time' => Yii::t('app', 'Work Time'),
            'phone' => Yii::t('app', 'Phone'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
