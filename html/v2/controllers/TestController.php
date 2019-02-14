<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.19
 * Time: 17:18
 */

namespace app\controllers;

use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, 1);
    }
}
