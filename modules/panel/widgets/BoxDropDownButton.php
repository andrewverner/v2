<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.04.19
 * Time: 11:24
 */

namespace app\modules\panel\widgets;

use yii\helpers\Html;

/**
 * Class BoxButton
 * @package app\modules\panel\widgets
 */
class BoxDropDownButton extends BoxButton
{
    /**
     * @var BoxButton[]
     */
    public $elements = [];

    public function run()
    {
        return $this->render('box-dropdown-button', ['button' => $this]);
    }
}
