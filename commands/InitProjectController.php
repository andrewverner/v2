<?php

namespace app\commands;

Class InitProjectController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $category = new \app\models\Category(['name' => 'Корень']);
        $category->makeRoot();
        $category->save();

        $user = new \app\models\User();
        $user->username = 'admin';
        $user->password = \Yii::$app->security->generatePasswordHash('cos45sqrt22');
        $user->email = 'email@domain.com';
        $user->active = 1;
        $user->save();

        $auth = \Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        $auth->assign($admin, $user->id);
    }
}
