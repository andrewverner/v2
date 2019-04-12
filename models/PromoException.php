<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promo_exception".
 *
 * @property int $id
 * @property int $promo_id
 * @property int $entity_type
 * @property int $entity_id
 * @property int $active
 * @property string $created
 * @property string $updated
 *
 * @property Item|Category $entity
 */
class PromoException extends \yii\db\ActiveRecord
{
    const ENTITY_TYPE_ITEM = 1;
    const ENTITY_TYPE_CATEGORY = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_exception';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['promo_id', 'entity_id'], 'required'],
            [['promo_id', 'entity_type', 'entity_id', 'active'], 'integer'],
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
            'promo_id' => Yii::t('app', 'Promo ID'),
            'entity_type' => Yii::t('app', 'Entity Type'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getEntity()
    {
        return $this->hasOne(
            $this->entity_type == self::ENTITY_TYPE_ITEM ? Item::class : Category::class,
            ['id' => 'entity_id']
        );
    }
}
