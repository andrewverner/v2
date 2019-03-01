<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.2019
 * Time: 20:36
 */

namespace app\modules\panel\assets;

class PanelAsset extends \yii\web\AssetBundle
{
    public $css = [
        'panel/css/panel.css',
    ];

    public $js = [
        'panel/js/alert.js',
        'panel/js/panel.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
