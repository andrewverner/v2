<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promo".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property int $discount
 * @property int $active
 * @property int $multiple
 * @property string $expired_at
 * @property string $created
 * @property string $updated
 */
class Promo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['discount', 'active', 'multiple'], 'integer'],
            [['expired_at', 'created', 'updated'], 'safe'],
            [['title', 'code'], 'string', 'max' => 45],
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
            'code' => Yii::t('app', 'Code'),
            'discount' => Yii::t('app', 'Discount'),
            'active' => Yii::t('app', 'Active'),
            'multiple' => Yii::t('app', 'Multiple'),
            'expired_at' => Yii::t('app', 'Expired At'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
