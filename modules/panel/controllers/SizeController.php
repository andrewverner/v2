<?php

namespace app\modules\panel\controllers;

use app\models\OrderItem;
use app\modules\panel\models\Notification;
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

        if (!$items = OrderItem::find()->where(['size_id' => $model->id])->all()) {
            Notification::add(
                'Can not drop size {value} (ID#{id}). There are order items which use this value. If you really want to delete this size, you have to delete order items records from DB.',
                [
                    'value' => $model->value,
                    'id' => $model->id,
                ],
                Notification::TYPE_ERROR
            );

            throw new BadRequestHttpException(Yii::t('app', 'Can not drop size. This action may cause data inconsistency. For more details please refer to notifications'));
        }

        $model->delete();
    }

    public function actionListForm()
    {
        return $this->renderPartial('_list-form', [
            'models' => Size::find()->all(),
        ]);
    }
}
