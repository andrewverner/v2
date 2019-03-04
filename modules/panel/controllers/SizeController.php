<?php

namespace app\modules\panel\controllers;

use Yii;
use app\models\Size;
use app\modules\panel\models\SizeSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SizeController implements the CRUD actions for Size model.
 */
class SizeController extends Controller
{
    public function init()
    {
        Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Sizes' => '/panel/size',
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

    /**
     * Lists all Size models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SizeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionForm()
    {
        $id = Yii::$app->request->post('id');
        $model = $id ? Size::findOne($id) : new Size();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('Size'), 'id');
        $model = $id ? Size::findOne($id) : new Size();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = Size::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Size not found'));
        }

        $model->delete();
    }
}
