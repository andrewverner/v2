<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_item_rel".
 *
 * @property int $id
 * @property int $item_id
 * @property int $related_item_id
 *
 * @property Item $item
 * @property Item $relatedItem
 */
class ItemItemRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_item_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'related_item_id'], 'required'],
            [['item_id', 'related_item_id'], 'integer'],
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
            'related_item_id' => Yii::t('app', 'Related Item ID'),
        ];
    }
}
