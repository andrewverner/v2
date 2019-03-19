<?php

namespace app\modules\panel\controllers;

use app\modules\panel\models\UploadModel;
use Yii;
use app\models\JumbotronSlide;
use app\modules\panel\models\JumbotronSlideSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JumbotronSlideController implements the CRUD actions for JumbotronSlide model.
 */
class JumbotronSlideController extends Controller
{
    public function init()
    {
        Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Jumbotron' => '/panel/jumbotron-slide',
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
                    'save' => ['POST', 'AJAX'],
                    'drop' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jumbotron slides models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JumbotronSlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->registerJsVar('slideId', $id);

        return $this->render('view', [
            'model' => JumbotronSlide::findOne($id),
            'uploadModel' => new UploadModel(),
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = JumbotronSlide::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JumbotronSlide();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('JumbotronSlide'), 'id');
        $model = $id ? JumbotronSlide::findOne($id) : new JumbotronSlide();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = JumbotronSlide::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Jumbotron slide not found'));
        }

        $model->delete();

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->urlManager->createUrl('/panel/jumbotron-slide'));
        }
    }
}
