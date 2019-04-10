<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.04.19
 * Time: 12:35
 */

namespace app\modules\panel\controllers;

use app\models\Order;
use app\models\OrderStatus;
use app\models\OrderStatusFlow;
use app\modules\panel\models\Notification;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

class OrderStatusController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['models' => OrderStatus::find()->all()]);
    }

    public function actionForm()
    {
        $id = \Yii::$app->request->post('id');
        $model = $id ? OrderStatus::findOne($id) : new OrderStatus();

        $colors = array_unique(array_column(OrderStatus::find()->all(), 'color'));

        return $this->renderPartial('_form', [
            'model' => $model,
            'colors' => $colors,
        ]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('OrderStatus'), 'id');
        $model = $id ? OrderStatus::findOne($id) : new OrderStatus();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if ($id == 1) {
            throw new NotAcceptableHttpException(\Yii::t('app', 'You can not drop status with ID #1'));
        }

        if (!$model = OrderStatus::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Order status not found'));
        }

        if (Order::find()->where(['status_id' => $model->id])->exists()) {
            Notification::add(
                'Can not drop order status {title} (ID#{id}). There are orders is this status. If you really want to delete this order status, you have to delete or change orders with this status.',
                [
                    'title' => $model->title,
                    'id' => $model->id,
                ],
                Notification::TYPE_ERROR
            );

            throw new BadRequestHttpException(\Yii::t('app', 'Can not drop size. This action may cause data inconsistency. For more details please refer to notifications'));
        }

        $model->delete();
    }

    public function actionFlowForm($id)
    {
        if (!$model = OrderStatus::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Order status not found'));
        }

        $flow = [];
        foreach (array_merge($model->prevStatuses, $model->nextStatuses) as $status) {
            $flow[$status->direction][$status->status->id] = $status->active;
        }

        return $this->renderPartial('_flow-form', [
            'model' => $model,
            'flow' => $flow,
            'statuses' => OrderStatus::find()->where('id <> :id', ['id' => $model->id])->all(),
        ]);
    }

    public function actionSaveFlow()
    {
        $id = \Yii::$app->request->post('id');
        $data = \Yii::$app->request->post('data');

        if (!$model = OrderStatus::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Order status not found'));
        }

        OrderStatusFlow::updateAll(['active' => 0], ['from_id' => $model->id]);

        foreach ($data as $row) {
            $flowModel = OrderStatusFlow::findOne([
                'from_id' => $model->id,
                'to_id' => $row['id'],
                'direction' => $row['direction']
            ]);
            if (!$flowModel) {
                $flowModel = new OrderStatusFlow();
                $flowModel->from_id = $model->id;
                $flowModel->to_id = $row['id'];
                $flowModel->direction = $row['direction'];
            }

            $flowModel->active = 1;
            $flowModel->save();
        }
    }
}
