<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.04.19
 * Time: 9:16
 */

namespace app\modules\panel\controllers;

use app\models\DeliveryType;
use app\models\Order;
use app\modules\panel\models\Notification;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class DeliveryTypeController extends Controller
{
    public function init()
    {
        Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Delivery types' => '/panel/delivery-type',
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ArrayDataProvider([
                'allModels' => DeliveryType::find()->all(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm($id = null)
    {
        $model = $id ? DeliveryType::findOne($id) : new DeliveryType();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('DeliveryType'), 'id');
        $model = $id ? DeliveryType::findOne($id) : new DeliveryType();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = DeliveryType::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Delivery type not found'));
        }

        if (Order::find()->where(['delivery_type' => $model->id])->all()) {
            Notification::add(
                'Can not drop delivery type {title} (ID#{id}). There are orders which are related to it. If you really want to delete this delivery type, you have to delete orders from DB.',
                [
                    'title' => $model->title,
                    'id' => $model->id,
                ],
                Notification::TYPE_ERROR
            );

            throw new BadRequestHttpException(Yii::t('app', 'Can not drop delivery type. This action may cause data inconsistency. For more details please refer to notifications'));
        }

        $model->delete();
    }
}
