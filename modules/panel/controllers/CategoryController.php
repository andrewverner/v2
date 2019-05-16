<?php

namespace app\modules\panel\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

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
                    'form' => ['POST', 'AJAX'],
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
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Category::find()->where('depth > 0'),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
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
        $model = $id ? Category::findOne($id) : new Category();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $parentId = Yii::$app->request->post('parent');
        $parent = Category::findOne($parentId);
        $model->appendTo($parent);
    }

    public function actionDrop($id)
    {
        if (!$model = Category::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Category not found'));
        }

        $model->deleteWithChildren();
    }

    public function actionItems($id)
    {
        if (!$model = Category::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Category not found'));
        }

        return $this->render('items', [
            'model' => $model,
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $model->itemRels,
                'pagination' => [
                    'pageSize' => 48,
                ],
            ]),
        ]);
    }
}
