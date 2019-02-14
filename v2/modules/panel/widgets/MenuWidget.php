<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.2019
 * Time: 20:56
 */

namespace app\modules\panel\widgets;

class MenuWidget extends \yii\base\Widget
{
    private $items = [];

    public function run()
    {
        $items = [
            '<i class="fas fa-bars"></i> Category' => '/panel/category',
        ];

        foreach ($items as $title => $url) {
            $this->addItem($title, $url);
        }

        return $this->render('menu', ['items' => $this->items]);
    }

    public function addItem($title, $url)
    {
        $this->items[$title] = \Yii::$app->urlManager->createUrl($url);
    }
}
