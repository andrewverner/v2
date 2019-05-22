<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 22.05.19
 * Time: 13:01
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class CreateOrderAsset extends AssetBundle
{
    public $baseUrl = '@web/panel';

    public $css = [
        //'css/create-order.css',
    ];

    public $js = [
        'js/create-order.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
