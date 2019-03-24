<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.2019
 * Time: 20:36
 */

namespace app\modules\panel\assets;

use yii\web\View;

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
        //'https://api-maps.yandex.ru/2.1/?apikey=6f317d4e-eb57-4700-bbae-e38519baa769&lang=en_US',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];

    public function init() {

        $this->jsOptions['position'] = View::POS_HEAD;

        parent::init();

    }
}
