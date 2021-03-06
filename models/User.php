<?php

namespace app\models;

use Yii;
use yii\base\Event;
use yii\data\ActiveDataProvider;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $active
 * @property int $blocked
 * @property string $created
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $phone
 *
 * @property string $fullName
 *
 * @property Order[] $orders
 * @property UserAddress[] $addresses
 * @property ActiveDataProvider $addressesDataProvider
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const CREATE_USER = 'createUser';

    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'onCreate'], ['user' => $this]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['active', 'blocked'], 'integer'],
            [['created'], 'safe'],
            [['username', 'email', 'first_name', 'last_name', 'middle_name', 'phone'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255],
            [['username', 'email'], 'checkForUnique']
        ];
    }

    public function checkForUnique($attribute)
    {
        if ($this->isNewRecord) {
            $model = self::findOne([
                $attribute => $this->{$attribute},
                'active' => 1,
            ]);

            if ($model) {
                $this->addError($attribute, Yii::t('app', '{attribute} is already taken', [
                    'attribute' => $this->attributeLabels()[$attribute],
                ]));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'active' => Yii::t('app', 'Active'),
            'blocked' => Yii::t('app', 'Blocked'),
            'created' => Yii::t('app', 'Created'),
            'first_name' => Yii::t('app', 'First name'),
            'last_name' => Yii::t('app', 'Last name'),
            'middle_name' => Yii::t('app', 'Middle name'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return false;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public static function create($username, $password, $email)
    {
        $user = new self;
        $user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);
        $user->email = $email;
        $user->save();

        return $user;
    }

    public static function findByUsername($username)
    {
        return self::findOne([
            'username' => $username,
            'active' => 1,
            'blocked' => 0,
        ]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    public function getAddresses()
    {
        return $this->hasMany(UserAddress::class, ['user_id' => 'id']);
    }

    public function getAddressesDataProvider()
    {
        return new ActiveDataProvider([
            'query' => UserAddress::find()->where(['user_id' => $this->id]),
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
    }

    public function onCreate(Event $event)
    {
        $user = $event->data['user'] ?? null;
        if (!$user instanceof $this) {
            return;
        }

        Hash::create($user->id);
    }

    public function getFullName($withUsername = false)
    {
        $fullName = implode(' ', array_filter([
            $this->last_name, $this->first_name, $this->middle_name
        ]));

        if ($fullName) {
            return $fullName . ($withUsername ? " ({$this->username})" : '');
        }

        return $this->username;
    }
}
