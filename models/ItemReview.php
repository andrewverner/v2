<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_review".
 *
 * @property int $id
 * @property int $item_id
 * @property int $user_id
 * @property string $reviewer
 * @property string $text
 * @property int $rating
 * @property int $allowed
 * @property string $created
 * @property string $updated
 */
class ItemReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'reviewer', 'text'], 'required'],
            [['item_id', 'user_id', 'rating', 'allowed'], 'integer'],
            [['text'], 'string'],
            [['created', 'updated'], 'safe'],
            [['reviewer'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('app', 'User ID'),
            'reviewer' => Yii::t('app', 'Reviewer'),
            'text' => Yii::t('app', 'Text'),
            'rating' => Yii::t('app', 'Rating'),
            'allowed' => Yii::t('app', 'Allowed'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
