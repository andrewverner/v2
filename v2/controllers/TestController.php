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
        $category = new Category(['name' => 'Корень']);
        $category->makeRoot();
        if ($category->validate()) {
            $category->save();
        } else {
            print_r($category->errors);
        }
    }
}
