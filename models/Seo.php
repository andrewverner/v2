<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property int $active
 * @property string $created
 * @property string $updated
 * @property string $entity_type
 * @property int $entity_id
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'entity_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['entity_type', 'entity_id'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['keywords', 'description'], 'string', 'max' => 1023],
            [['entity_type'], 'string', 'max' => 45],
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
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'entity_type' => Yii::t('app', 'Entity Type'),
            'entity_id' => Yii::t('app', 'Entity ID'),
        ];
    }
}
