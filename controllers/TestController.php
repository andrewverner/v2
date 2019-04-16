<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.19
 * Time: 17:18
 */

namespace app\controllers;

use app\models\OrderStatus;
use app\models\Promo;

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
        $promo = Promo::findOne(1);
        var_dump($promo);
    }
}
