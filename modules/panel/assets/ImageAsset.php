<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 20:44
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class ImageAsset extends AssetBundle
{
    public $js = [
        'js/image.js',
    ];

    public $depends = [
        'app\modules\panel\assets\PanelAsset',
    ];
}
