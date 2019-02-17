<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $path
 * @property string $name
 * @property int $size
 * @property string $created
 * @property string $updated
 * @property string $tags
 *
 * @property string $source;
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'name', 'size'], 'required'],
            [['size'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['path', 'name'], 'string', 'max' => 45],
            [['tags'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'name' => Yii::t('app', 'Name'),
            'size' => Yii::t('app', 'Size'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'tags' => Yii::t('app', 'Tags'),
        ];
    }

    public function getSource()
    {
        return "{$this->path}{$this->name}";
    }
}
