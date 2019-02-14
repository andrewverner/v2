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
    public $baseUrl = '@web/panel';

    public $css = [
        'css/panel.css',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
