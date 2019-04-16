<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email_template".
 *
 * @property int $id
 * @property string $key
 * @property string $description
 * @property string $template
 * @property string $created
 * @property string $updated
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'template'], 'required'],
            [['template'], 'string'],
            [['created', 'updated'], 'safe'],
            [['key'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'description' => Yii::t('app', 'Description'),
            'template' => Yii::t('app', 'Template'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
