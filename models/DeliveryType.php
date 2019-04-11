<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_type".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $active
 * @property int $address_needed
 * @property int $cost
 * @property string $created
 * @property string $updated
 */
class DeliveryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['active', 'address_needed', 'cost'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 1024],
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
            'active' => Yii::t('app', 'Active'),
            'address_needed' => Yii::t('app', 'Address Needed'),
            'cost' => Yii::t('app', 'Cost'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
