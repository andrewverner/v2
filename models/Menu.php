<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $parent
 * @property string $title
 * @property string $url
 * @property int $active
 * @property string $created
 * @property string $updated
 * @property int $weight
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'active', 'weight'], 'integer'],
            [['title', 'url'], 'required'],
            [['created', 'updated'], 'safe'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'weight' => Yii::t('app', 'Weight'),
        ];
    }

    public function beforeValidate()
    {
        if (!$this->weight) {
            $this->weight = 0;
        }

        return parent::beforeValidate();
    }
}
