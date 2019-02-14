<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.19
 * Time: 17:20
 */

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PanelController extends Controller
{
    public function behaviors()
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
    }

    public function actionIndex()
    {

    }
}
