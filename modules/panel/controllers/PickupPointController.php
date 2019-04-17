<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.04.19
 * Time: 9:46
 */

namespace app\modules\panel\controllers;

use app\models\Order;
use app\models\PickupPoint;
use app\modules\panel\models\Notification;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PickupPointController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PickupPoint::find(),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionForm($id = null)
    {
        $model = $id ? PickupPoint::findOne($id) : new PickupPoint();

        return $this->renderAjax('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('PickupPoint'), 'id');
        $model = $id ? PickupPoint::findOne($id) : new PickupPoint();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = PickupPoint::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Pickup point not found'));
        }

        if (Order::find()->where(['pickup_point_id' => $model->id])->all()) {
            Notification::add(
                'Can not drop pickup point {address} (ID#{id}). There are order orders which related to it. If you really want to delete this pickup point, you have to delete order records from DB.',
                [
                    'value' => $model->address,
                    'id' => $model->id,
                ],
                Notification::TYPE_ERROR
            );

            throw new BadRequestHttpException(Yii::t('app', 'Can not drop pickup point. This action may cause data inconsistency. For more details please refer to notifications'));
        }

        $model->delete();
    }
}
