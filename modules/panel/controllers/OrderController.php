<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 11:15
 */

namespace app\modules\panel\controllers;

use app\models\Order;
use app\models\OrderStatus;
use app\models\OrderStatusLog;
use app\models\User;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

    public function actionStatusFlow()
    {
        if (!$id = \Yii::$app->request->post('id')) {
            throw new BadRequestHttpException(\Yii::t('app', 'Invalid data'));
        }

        if (!$order = Order::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Order not found'));
        }

        return $this->renderPartial('_status-flow', ['model' => $order->status]);
    }

    public function actionChangeStatus()
    {
        $id = \Yii::$app->request->post('id');
        $statusId = \Yii::$app->request->post('status');

        if (!$id || !$statusId) {
            throw new BadRequestHttpException(\Yii::t('app', 'Invalid data'));
        }

        if (!$order = Order::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Order not found'));
        }

        if (!$status = OrderStatus::findOne($statusId)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Status not found'));
        }

        $order->status_id = $statusId;
        if (!$order->save()) {
            throw new BadRequestHttpException(\Yii::t('app', 'Validation error'));
        }

        OrderStatusLog::create($order, $status);
    }
}
