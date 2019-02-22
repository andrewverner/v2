<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 12:25
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;

class MenuWidget extends Widget
{
    public function run()
    {
        $items = [
            'Categories' => '/panel/category',
            'Sizes' => '/panel/size',
            'Items' => '/panel/item',
            'Images' => '/panel/image',
            'SEO' => '/panel/seo',
            'Url manager' => '/panel/url-manager',
            'Jumbotron' => '/panel/jumbotron-slide',
            'Pages' => '/panel/page',
            'Blocks' => '/panel/block',
            'News' => '/panel/news',
            'Users' => '/panel/user',
        ];

        return $this->render('menu', ['items' => $items]);
    }
}
