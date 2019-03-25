<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "hash".
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property int $type
 * @property string $expired_at
 * @property int $used
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 */
class Hash extends ActiveRecord
{
    const TYPE_ACTIVATE = 1;
    const TYPE_RESET_PASSWORD = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hash';
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
            [['user_id', 'hash', 'type', 'expired_at'], 'required'],
            [['user_id', 'type', 'used'], 'integer'],
            [['expired_at', 'created', 'updated'], 'safe'],
            [['hash'], 'string', 'max' => 255],
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
            'hash' => Yii::t('app', 'Hash'),
            'type' => Yii::t('app', 'Type'),
            'expired_at' => Yii::t('app', 'Expired At'),
            'used' => Yii::t('app', 'Used'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * Create new or update old hash
     *
     * @param $userId
     * @param int $type
     * @return string
     */
    public static function create($userId, $type = self::TYPE_ACTIVATE)
    {
        $model = self::get($userId, $type);

        if (!$model) {
            $model = new self;
            $model->user_id = $userId;
            $model->hash = md5("{$userId}:" . time() . ':' . uniqid());
            $model->type = $type;
        }

        $model->expired_at = new Expression('NOW() + INTERVAL 1 DAY');
        $model->save();

        return $model->hash;
    }

    /**
     * Is hash expired
     *
     * @return bool
     * @throws \Exception
     */
    public function isExpired()
    {
        return (new \DateTime() >= new \DateTime($this->expired_at));
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        $this->updated = new Expression('NOW()');

        return parent::beforeSave($insert);
    }

    /**
     * Is hash valid
     *
     * @return bool
     * @throws \Exception
     */
    public function isValid()
    {
        return !$this->isExpired() && !$this->used;
    }

    /**
     * Returns hash by value
     *
     * @param $hash
     * @return Hash|null
     */
    public static function findByHash($hash)
    {
        $hash = self::findOne(['hash' => $hash]);
        if (!$hash || !$hash->isValid()) {
            return null;
        }

        return $hash;
    }

    /**
     * Returns user that related to hash
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
