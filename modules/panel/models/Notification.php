<?php

namespace app\modules\panel\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int $type
 * @property string $text
 * @property string $params
 * @property int $viewed
 * @property string $datetime
 */
class Notification extends \yii\db\ActiveRecord
{
    const TYPE_INFO = 1;
    const TYPE_WARNING = 2;
    const TYPE_ERROR = 3;
    const TYPE_FATAL = 4;

    const ICON_CLASS = [
        self::TYPE_INFO => 'fas fa-info-circle text-blue',
        self::TYPE_WARNING => 'fas fa-exclamation-triangle text-orange',
        self::TYPE_ERROR => 'fas fa-exclamation-circle text-red',
        self::TYPE_FATAL => 'fas fa-radiation text-red',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'viewed'], 'integer'],
            [['text'], 'required'],
            [['text'], 'string'],
            [['datetime'], 'safe'],
            [['params'], 'string', 'max' => 2048],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'text' => Yii::t('app', 'Text'),
            'params' => Yii::t('app', 'Params'),
            'viewed' => Yii::t('app', 'Viewed'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    public static function add($text, $params = null, $type = self::TYPE_INFO)
    {
        $model = new self;
        $model->text = $text;
        if ($params) {
            $model->params = Json::encode($params);
        }
        $model->type = $type;
        $model->save();
    }

    public function getIconClass()
    {
        return self::ICON_CLASS[$this->type];
    }

    public function getParams()
    {
        return $this->params ? Json::decode($this->params) : [];
    }
}
