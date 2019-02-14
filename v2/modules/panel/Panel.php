<?php

namespace app\modules\panel;

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

        \Yii::$app->view->theme = new \yii\base\Theme([
            'pathMap' => ['@app/views' => '@app/modules/panel/views'],
            'baseUrl' => '@web/panel',
        ]);
    }
}
