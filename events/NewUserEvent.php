<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 23.03.2019
 * Time: 11:58
 */

namespace app\events;

use yii\base\Event;

class NewUserEvent extends Event
{
    public $user;
}
