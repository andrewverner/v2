<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 21.03.2019
 * Time: 20:33
 */

namespace app\modules\panel\controllers;

use app\models\Counter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CounterController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Pixels & counters' => '/panel/counter',
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Counter::find(),
            ]),
        ]);
    }

    public function actionForm()
    {
        $id = \Yii::$app->request->post('id');
        $model = $id ? Counter::findOne($id) : new Counter();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('Counter'), 'id');
        $model = $id ? Counter::findOne($id) : new Counter();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = Counter::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Record not found'));
        }

        $model->delete();
    }
}
