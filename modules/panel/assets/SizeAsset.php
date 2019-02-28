<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.02.19
 * Time: 10:21
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class SizeAsset extends AssetBundle
{
    public $js = [
        'panel/js/size.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
