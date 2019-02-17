<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "item_image".
 *
 * @property int $id
 * @property int $item_id
 * @property int $image_id
 * @property int $is_main
 * @property string $created
 * @property string $updated
 *
 * @property Image $image
 */
class ItemImage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_image';
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
            [['item_id', 'image_id'], 'required'],
            [['item_id', 'image_id', 'is_main'], 'integer'],
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
            'image_id' => Yii::t('app', 'Image ID'),
            'is_main' => Yii::t('app', 'Is Main'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}
