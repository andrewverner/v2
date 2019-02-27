<?php

namespace app\modules\panel;

use yii\web\NotFoundHttpException;

/**
 * panel module definition class
 */
class Panel extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\panel\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (\Yii::$app->user->isGuest || !\Yii::$app->user->can('admin')) {
            throw new NotFoundHttpException(\Yii::t('app', 'Page not found'));
        }

        \Yii::$app->view->theme = new \yii\base\Theme([
            'pathMap' => ['@app/views' => '@app/modules/panel/views'],
            'baseUrl' => '@web/panel',
        ]);
    }
}
