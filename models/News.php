<?php

namespace app\models;

use app\components\behaviors\SeoBehavior;
use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $published
 * @property string $created
 * @property string $updated
 *
 * @property Seo $seo
 */
class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => SeoBehavior::className(),
                'model' => $this,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['published'], 'integer'],
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
            'text' => Yii::t('app', 'Text'),
            'published' => Yii::t('app', 'Published'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function beforeDelete()
    {
        if ($seo = $this->seo) {
            $seo->delete();
        }

        return parent::beforeDelete();
    }
}
