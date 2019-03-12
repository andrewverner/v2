<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_property_value".
 *
 * @property int $id
 * @property int $property_id
 * @property string $value
 * @property string $created
 * @property string $updated
 */
class ItemPropertyValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_property_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id', 'value'], 'required'],
            [['property_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'value' => Yii::t('app', 'Value'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
