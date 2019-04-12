<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.04.19
 * Time: 11:24
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class BoxButton
 * @package app\modules\panel\widgets
 */
class BoxButton extends Widget
{
    public $title;

    public $type  = 'span';

    public $icon;

    public $options = [];

    public function run()
    {
        if ($this->icon) {
            $this->icon = '<i class="' . $this->icon . '"></i>';
        }

        return Html::tag(
            $this->type,
            implode(' ', array_filter([$this->icon, \Yii::t('app', $this->title)])),
            $this->options
        );
    }
}
