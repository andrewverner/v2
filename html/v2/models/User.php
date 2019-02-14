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
            [['username', 'email'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255],
        ];
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
}
