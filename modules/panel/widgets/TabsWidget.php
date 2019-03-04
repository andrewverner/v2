<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 04.03.19
 * Time: 14:39
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;

class TabsWidget extends Widget
{
    public $tabs;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        if (!array_column($this->tabs, 'active')) {
            $this->tabs[0]['active'] = true;
        }

        return $this->render('tabs', [
            'content' => $content,
            'tabs' => $this->tabs,
        ]);
    }

    public function addTab($title, $content)
    {
        $this->tabs[] = [
            'title' => $title,
            'content' => $content,
        ];
    }
}
