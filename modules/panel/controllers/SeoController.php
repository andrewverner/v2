<?php

namespace app\modules\panel\controllers;

use app\models\Category;
use app\models\Item;
use app\models\News;
use app\models\Page;
use app\models\Seo;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeoController implements the CRUD actions for Seo model.
 */
class SeoController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Seo' => '/panel/seo',
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
                'query' => Seo::find(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm()
    {
        $id = \Yii::$app->request->post('id');
        $model = $id ? Seo::findOne($id) : new Seo();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('Seo'), 'id');
        $model = $id ? Seo::findOne($id) : new Seo();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = Seo::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Seo record not found'));
        }

        $model->delete();
    }

    public function actionFormByEntity($type, $id)
    {
        $model = Seo::find()->where([
            'entity_type' => $type,
            'entity_id' => $id,
        ])->one() ?? new Seo();

        if ($model->isNewRecord) {
            switch ($type) {
                case Item::class:
                    $entityModel = Item::findOne($id);
                    $model->title = $entityModel->title ?? null;
                    break;
                case Page::class:
                    $entityModel = Page::findOne($id);
                    $model->title = $entityModel->title ?? null;
                    break;
                case News::class:
                    $entityModel = News::findOne($id);
                    $model->title = $entityModel->title ?? null;
                    break;
                case Category::class:
                    $entityModel = Category::findOne($id);
                    $model->title = $entityModel->name ?? null;
                    break;
                default:
                    $entityModel = null;
            }

            $model->entity_id = $id;
            $model->entity_type = $type;
        }

        return $this->renderPartial('_form', ['model' => $model]);
    }
}
