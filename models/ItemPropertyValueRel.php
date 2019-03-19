<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_property_value_rel".
 *
 * @property int $id
 * @property int $item_id
 * @property int $property_value_id
 * @property string $created
 * @property string $updated
 *
 * @property Item $item
 * @property ItemPropertyValue $propertyValue
 */
class ItemPropertyValueRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_property_value_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'property_value_id'], 'required'],
            [['item_id', 'property_value_id'], 'integer'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'property_value_id' => Yii::t('app', 'Property Value ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    public function getPropertyValue()
    {
        return $this->hasOne(ItemPropertyValue::class, ['id' => 'property_value_id']);
    }
}
