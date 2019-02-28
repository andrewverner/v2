<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.02.19
 * Time: 10:21
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class CategoryAsset extends AssetBundle
{
    public $js = [
        'panel/js/category.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
