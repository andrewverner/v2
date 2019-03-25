<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.03.19
 * Time: 10:51
 */

namespace app\modules\panel\controllers;

use app\models\ItemReserve;
use app\models\Store;
use app\modules\panel\models\Notification;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StoreController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Stores' => '/panel/store',
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Store::find()->orderBy(['title' => SORT_ASC]),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm($id = null)
    {
        $model = $id ? Store::findOne($id) : new Store();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('Store'), 'id');
        $model = $id ? Store::findOne($id) : new Store();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = Store::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Store not found'));
        }

        if (ItemReserve::find()->where(['store_id' => $model->id])->exists()) {
            Notification::add(
                'Can not drop store {title} (ID#{id}). There are items reserves related to id. If you really want to delete this store, you have to delete items reserves from DB.',
                [
                    'title' => $model->title,
                    'id' => $model->id,
                ],
                Notification::TYPE_ERROR
            );

            throw new BadRequestHttpException(\Yii::t('app', 'Can not drop store. This action may cause data inconsistency. For more details please refer to notifications'));
        }

        $model->delete();
    }
}
