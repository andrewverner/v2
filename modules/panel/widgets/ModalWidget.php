<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.02.19
 * Time: 13:52
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;

class ModalWidget extends Widget
{
    public $id;
    public $type;
    public $backdrop = true;
    public $keyboard = true;
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

        return $this->render('modal', [
            'widget' => $this,
            'content' => $content,
        ]);
    }

    public function addButton(ModalButtonWidget $modalButtonWidget)
    {
        $this->buttons[] = $modalButtonWidget;
    }
}
