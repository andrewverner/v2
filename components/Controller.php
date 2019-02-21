<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.02.19
 * Time: 17:37
 */

namespace app\components;

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        var_dump(\Yii::$app->request->getUrl());
        var_dump(\Yii::$app->urlManager->getBaseUrl());

        return parent::beforeAction($action);
    }
}
