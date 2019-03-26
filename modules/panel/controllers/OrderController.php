<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 11:15
 */

namespace app\modules\panel\controllers;

use app\models\Order;
use app\models\User;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class OrderController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Orders' => '/panel/order',
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ArrayDataProvider([
                'allModels' => Order::find()->orderBy(['created' => SORT_DESC])->all(),
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]),
        ]);
    }

    public function actionUserList()
    {
        return $this->renderPartial('_user-list', [
            'models' => User::find()
                ->where([
                    'active' => 1,
                    'blocked' => 0,
                ])
                ->all(),
        ]);
    }

    public function actionCreate()
    {

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Order::findOne($id),
        ]);
    }
}
