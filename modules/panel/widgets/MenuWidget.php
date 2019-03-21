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
            new MenuItem('Shop', 'fas fa-shopping-cart', null, [
                new MenuItem('Categories', 'fas fa-list-ul', '/panel/category'),
                new MenuItem('Sizes', 'fas fa-filter', '/panel/size'),
                new MenuItem('Properties', 'fas fa-filter', '/panel/property'),
                new MenuItem('Items', 'fas fa-boxes', '/panel/item'),
            ]),
            new MenuItem('Content', 'far fa-newspaper', null, [
                new MenuItem('Pages', 'fas fa-file-alt', '/panel/page'),
                new MenuItem('Blocks', 'fas fa-th', '/panel/block'),
                new MenuItem('News', 'fas fa-newspaper', '/panel/news'),
                new MenuItem('Jumbotron', 'fas fa-desktop', '/panel/jumbotron-slide'),
                new MenuItem('Images', 'fas fa-images', '/panel/image'),
            ]),
            new MenuItem('Options', 'fas fa-cogs', null, [
                new MenuItem('Menu', 'fas fa-bars', '/panel/menu'),
                new MenuItem('SEO', 'fas fa-globe', '/panel/seo'),
                new MenuItem('Pixels & counters', 'fas fa-scroll', '/panel/counter'),
                new MenuItem('Url manager', 'fas fa-location-arrow', '/panel/url-manager'),
                new MenuItem('Logs', 'fas fa-book', '/panel/log'),
            ]),
            new MenuItem('Users', 'fas fa-users', '/panel/user'),
            new MenuItem('Orders', 'fas fa-luggage-cart', '/panel/order'),
        ];

        return $this->render('menu', ['items' => $items]);
    }
}
