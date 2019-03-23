<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 22.03.2019
 * Time: 22:54
 */

namespace app\components;

use yii\base\Component;

class Notifier extends Component
{
    public function userCreateEmail()
    {
        $mailer = \Yii::$app->mailer;
        $mailer->compose()
            ->setFrom('');
    }
}
