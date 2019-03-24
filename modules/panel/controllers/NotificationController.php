<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 13:49
 */

namespace app\modules\panel\controllers;

use app\modules\panel\widgets\NotificationWidget;
use yii\web\Controller;

class NotificationController extends Controller
{
    public function actionWidget()
    {
        echo NotificationWidget::widget();
    }
}
