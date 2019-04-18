<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 23.03.2019
 * Time: 18:01
 */

namespace app\modules\panel\controllers;

use app\components\Controller;
use app\components\settings\Settings;

class SettingsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'common' => Settings::instance()->common(),
        ]);
    }
}
