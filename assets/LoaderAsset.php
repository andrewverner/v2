<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.02.19
 * Time: 9:48
 */

namespace app\assets;

use yii\web\AssetBundle;

class LoaderAsset extends AssetBundle
{
    public $css = [
        'css/loader.css',
    ];

    public $js = [
        'js/loader.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
