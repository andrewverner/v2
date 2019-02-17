<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "item_size".
 *
 * @property int $id
 * @property int $item_id
 * @property int $size_id
 * @property int $published
 * @property string $created
 * @property string $updated
 *
 * @property Size $size
 */
class ItemSize extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_size';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'size_id'], 'required'],
            [['item_id', 'size_id', 'published'], 'integer'],
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
            'size_id' => Yii::t('app', 'Size ID'),
            'published' => Yii::t('app', 'Published'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getSize()
    {
        return $this->hasOne(Size::className(), ['id' => 'size_id']);
    }
}
