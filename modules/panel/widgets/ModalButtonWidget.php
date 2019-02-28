<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.02.19
 * Time: 14:10
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class ModalButtonWidget extends Widget
{
    public $options = [
        'class' => 'btn',
    ];
    public $title = '';

    public function __toString()
    {
        return Html::button($this->title, $this->options);
    }
}
