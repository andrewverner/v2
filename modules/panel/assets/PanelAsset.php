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
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/css/suggestions.min.css',
    ];

    public $js = [
        'panel/js/alert.js',
        'panel/js/panel.js',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/js/jquery.suggestions.min.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
