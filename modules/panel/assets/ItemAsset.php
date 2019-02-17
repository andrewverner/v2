<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:52
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class ItemAsset extends AssetBundle
{
    public $baseUrl = '@web/panel';

    public $css = [
        'css/item.css',
    ];

    public $js = [
        'js/item.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
