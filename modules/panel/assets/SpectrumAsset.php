<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:52
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class SpectrumAsset extends AssetBundle
{
    public $baseUrl = '@web/panel';

    public $css = [
        'css/spectrum.css',
    ];

    public $js = [
        'js/spectrum.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
