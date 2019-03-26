<?php

namespace app\modules\panel\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `panel` module
 */
class PanelController extends Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
                'denyCallback' => function () {
                    throw new NotFoundHttpException(\Yii::t('app', 'Page not found'));
                }
            ],
        ];
    }*/

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }
}
