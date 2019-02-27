<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.19
 * Time: 17:18
 */

namespace app\controllers;

use app\models\Category;
use yii\web\Controller;

class TestController extends \app\components\Controller
{
    public function actionIndex()
    {
        $role = \Yii::$app->authManager->getRole('admin');
        \Yii::$app->authManager->assign($role, 1);
    }

    public function actionDiff()
    {
        $old = [
            'a' => 1,
            'b' => 2,
        ];

        $new = [
            'a' => 1,
            'b' => 3,
        ];

        print_r(array_diff_assoc($old, $new));
        print_r(array_diff_assoc($new, $old));
    }
}
