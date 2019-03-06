<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 06.03.19
 * Time: 9:15
 */

namespace app\modules\panel\controllers;

use app\components\Controller;
use yii\data\ActiveDataProvider;
use app\models\Menu;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class MenuController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Menu' => '/panel/menu',
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
                'query' => Menu::find(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm()
    {
        $id = \Yii::$app->request->post('id');
        $model = $id ? Menu::findOne($id) : new Menu();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('Menu'), 'id');
        $model = $id ? Menu::findOne($id) : new Menu();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = Menu::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Size not found'));
        }

        $model->delete();
    }
}
