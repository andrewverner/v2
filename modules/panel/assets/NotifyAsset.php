<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 17:33
 */

namespace app\modules\panel\assets;

use yii\web\AssetBundle;

class NotifyAsset extends AssetBundle
{
    public $baseUrl = '@web/panel';

    public $js = [
        'js/notify.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
