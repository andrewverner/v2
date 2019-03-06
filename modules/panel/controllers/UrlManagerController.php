<?php

namespace app\modules\panel\controllers;

use http\Url;
use Yii;
use app\models\UrlManager;
use app\modules\panel\models\UrlManagerSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UrlManagerController implements the CRUD actions for UrlManager model.
 */
class UrlManagerController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Url manager' => '/panel/url-manager',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'form' => ['POST', 'AJAX'],
                    'save' => ['POST', 'AJAX'],
                    'drop' => ['POST', 'AJAX'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => UrlManager::find(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm()
    {
        $id = \Yii::$app->request->post('id');
        $model = $id ? UrlManager::findOne($id) : new UrlManager();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('UrlManager'), 'id');
        $model = $id ? UrlManager::findOne($id) : new UrlManager();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = UrlManager::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Url manager record not found'));
        }

        $model->delete();
    }
}
