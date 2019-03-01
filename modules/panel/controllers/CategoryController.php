<?php

namespace app\modules\panel\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public function init()
    {
        Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Categories' => '/panel/category',
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
                    'form' => ['POST'],
                    'save' => ['POST', 'AJAX'],
                    'drop' => ['POST', 'AJAX'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionForm()
    {
        $id = Yii::$app->request->post('id');
        $model = $id ? Category::findOne($id) : new Category();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('Category'), 'id');
        $model = $id ? Category::findOne($id) : new Category(Yii::$app->request->post('Category'));
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $parentId = Yii::$app->request->post('parent');
        $parent = Category::findOne($parentId);
        $model->appendTo($parent);
    }

    public function actionDrop()
    {

    }
}
