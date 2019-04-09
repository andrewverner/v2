<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.19
 * Time: 17:18
 */

namespace app\controllers;

use app\models\OrderStatus;

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
        $status = OrderStatus::findOne(3);
        var_dump($status->nextStatuses[0]->status->title);
        var_dump($status->prevStatuses[0]->status->title);
    }
}
