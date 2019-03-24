<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 13:21
 */

namespace app\modules\panel\widgets;

use app\modules\panel\models\Notification;
use yii\base\Widget;

class NotificationWidget extends Widget
{
    public function run()
    {
        $models = Notification::find()->where(['viewed' => 0])->all();

        return $this->render('notification', ['models' => $models]);
    }
}
