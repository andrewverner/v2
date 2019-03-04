<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 04.03.19
 * Time: 10:44
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;

class BoxWidget extends Widget
{
    public $title;

    public $buttons = [];

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        return $this->render('box', [
            'content' => $content,
            'buttons' => $this->buttons,
            'title' => $this->title,
        ]);
    }

    public function addButton($html)
    {
        $this->buttons[] = $html;
    }
}
