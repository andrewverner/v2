<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property int $id
 * @property int $user_id
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $house
 * @property string $flat
 * @property string $zip_code
 * @property double $geo_lat
 * @property double $geo_lng
 * @property string $kladr_id
 * @property string $fias_id
 * @property string $unrestricted_value
 *
 * @property User $user
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'country', 'city', 'street', 'house', 'zip_code'], 'required'],
            [['user_id'], 'integer'],
            [['geo_lat', 'geo_lng'], 'number'],
            [['country', 'region', 'city', 'street', 'flat'], 'string', 'max' => 45],
            [['house', 'zip_code'], 'string', 'max' => 10],
            [['kladr_id', 'fias_id', 'unrestricted_value'], 'string', 'max' => 255],
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
            'country' => Yii::t('app', 'Country'),
            'region' => Yii::t('app', 'Region'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'house' => Yii::t('app', 'House'),
            'flat' => Yii::t('app', 'Flat'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'geo_lat' => Yii::t('app', 'Geo Lat'),
            'geo_lng' => Yii::t('app', 'Geo Lng'),
            'kladr_id' => Yii::t('app', 'Kladr ID'),
            'fias_id' => Yii::t('app', 'Fias ID'),
            'unrestricted_value' => Yii::t('app', 'Unrestricted Value'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
