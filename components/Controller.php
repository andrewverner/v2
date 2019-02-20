<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.02.19
 * Time: 17:37
 */

namespace app\components;

use app\models\Seo;

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        \Yii::$app->getView()->registerMetaTag([
            'name' => 'keywords',
            'content' => 'some keywords',
        ]);
        \Yii::$app->getView()->registerMetaTag([
            'name' => 'description',
            'content' => 'Some description',
        ]);

        return parent::beforeAction($action);
    }
}
