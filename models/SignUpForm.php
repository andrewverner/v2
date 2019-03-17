<?php
namespace app\models;

use yii\base\Model;

class SignUpForm extends Model
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password1;

    /**
     * @var string
     */
    public $password2;

    /**
     * @var string
     */
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password1', 'password2', 'email'], 'required'],
            [['username', 'password1', 'password2', 'email'], 'filter', 'filter' => 'trim'],
            [['password1', 'password2'], 'string', 'min' => 6, 'max' => 18],
            [['password2'], 'compare', 'compareAttribute' => 'password1'],
            [['username', 'email'], 'string', 'min' => 6, 'max' => 45],
            [['email'], 'email'],
            [['username', 'email'], 'checkUnique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app', 'Username'),
            'password1' => \Yii::t('app', 'Password'),
            'password2' => \Yii::t('app', 'Password confirmation'),
            'email' => \Yii::t('app', 'Email'),
        ];
    }

    public function checkUnique($attribute)
    {
        $exists = User::find()->where([
            $attribute => $this->{$attribute},
            'active' => 1,
        ])->exists();

        if ($exists) {
            $this->addError($attribute, \Yii::t('app', 'This {attribute} is already taken', [
                'attribute' => $this->attributeLabels()[$attribute],
            ]));
        }
    }
}
