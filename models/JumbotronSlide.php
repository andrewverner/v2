<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jumbotron_slide".
 *
 * @property int $id
 * @property int $image_id
 * @property string $url
 * @property string $title
 * @property string $text
 * @property int $active
 * @property string $created
 * @property string $updated
 *
 * @property Image $image
 */
class JumbotronSlide extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jumbotron_slide';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['image_id', 'active'], 'integer'],
            [['text'], 'string'],
            [['created', 'updated'], 'safe'],
            [['url', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image_id' => Yii::t('app', 'Image ID'),
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }
}
