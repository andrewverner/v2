<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property int $id
 * @property string $code
 * @property string $text
 * @property int $position
 * @property int $type
 * @property int $active
 * @property string $created
 * @property string $updated
 */
class Block extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 1;
    const TYPE_PRODUCTS_LIST = 2;

    const POSITION_MAIN_PAGE_TOP = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'position'], 'required'],
            [['text'], 'string'],
            [['position', 'type', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['code'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'text' => Yii::t('app', 'Text'),
            'position' => Yii::t('app', 'Position'),
            'type' => Yii::t('app', 'Type'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public static function getTypesList($id = null)
    {
        $list = [
            self::TYPE_TEXT => Yii::t('app', 'Text'),
            self::TYPE_PRODUCTS_LIST => Yii::t('app', 'Products list'),
        ];

        return $id ? ($list[$id] ?? null) : $list;
    }

    public static function getPositionsList($id = null)
    {
        $list = [
            self::POSITION_MAIN_PAGE_TOP => Yii::t('app', 'Top section of the main page'),
        ];

        return $id ? ($list[$id] ?? null) : $list;
    }
}
