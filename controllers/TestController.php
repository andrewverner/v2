<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.19
 * Time: 17:18
 */

namespace app\controllers;

use app\components\Yii;
use app\models\Category;
use app\models\User;
use yii\base\Event;
use yii\web\Controller;

class TestController extends \app\components\Controller
{
    public function actionDadata()
    {
        return $this->render('dadata');
    }

    public function actionYMaps()
    {
        return $this->render('y-maps');
    }

    public function actionIndex()
    {
        var_dump(Yii::app);
    }
}
