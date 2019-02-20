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

class TestController extends Controller
{
    public function actionIndex()
    {
        $role = \Yii::$app->authManager->getRole('admin');
        \Yii::$app->authManager->assign($role, 1);
    }

    public function actionSeo()
    {
        $category = Category::findOne(1);
        var_dump($category->seo);
    }
}
