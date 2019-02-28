<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.02.19
 * Time: 9:47
 */

namespace app\widgets;

use yii\base\Widget;

class LoaderWidget extends Widget
{
    public function run()
    {
        return $this->render('loader');
    }
}
