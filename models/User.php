<?php

namespace app\models;

use Yii;
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
 * @property Order[] $orders
 * @property UserAddress[] $addresses
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
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
            [['username', 'email', 'first_name', 'last_name' ,'middle_name' ,'phone'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255],
            [['username', 'email'], 'checkForUnique']
        ];
    }

    public function checkForUnique($attribute)
    {
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

    public static function create(SignUpForm $form)
    {
        $user = new self;
        $user->username = $form->username;
        $user->password = Yii::$app->security->generatePasswordHash($form->password1);
        $user->email = $form->email;
        $user->save();

        Hash::create($user->id);

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
}
