<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_property".
 *
 * @property int $id
 * @property string $title
 * @property int $multiple
 * @property int $filterable
 * @property string $created
 * @property string $updated
 *
 * @property ItemPropertyValue[] $values
 */
class ItemProperty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['multiple', 'filterable'], 'integer'],
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
            'multiple' => Yii::t('app', 'Multiple'),
            'filterable' => Yii::t('app', 'Filterable'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getValues()
    {
        return $this->hasMany(ItemPropertyValue::class, ['property_id' => 'id']);
    }

    public function beforeDelete()
    {
        foreach ($this->values as $value) {
            $value->delete();
        }

        return parent::beforeDelete();
    }
}
