<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.04.19
 * Time: 15:41
 */

namespace app\modules\panel\controllers;

use app\models\Promo;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class PromoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Promo::find(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm($id = null)
    {
        $model = $id ? Promo::findOne($id) : new Promo();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('Promo'), 'id');
        $model = $id ? Promo::findOne($id) : new Promo();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = Promo::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Promo not found'));
        }

        /*if (OrderItem::find()->where(['size_id' => $model->id])->all()) {
            Notification::add(
                'Can not drop size {value} (ID#{id}). There are order items which use this value. If you really want to delete this size, you have to delete order items records from DB.',
                [
                    'value' => $model->value,
                    'id' => $model->id,
                ],
                Notification::TYPE_ERROR
            );

            throw new BadRequestHttpException(Yii::t('app', 'Can not drop size. This action may cause data inconsistency. For more details please refer to notifications'));
        }*/

        $model->delete();
    }
}
