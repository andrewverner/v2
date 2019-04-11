<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_cart".
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property int $size_id
 * @property int $quantity
 * @property int $status
 * @property string $created
 * @property string $updated
 */
class UserCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id'], 'required'],
            [['user_id', 'item_id', 'size_id', 'quantity', 'status'], 'integer'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'size_id' => Yii::t('app', 'Size ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
