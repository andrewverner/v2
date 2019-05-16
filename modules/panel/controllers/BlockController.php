<?php

namespace app\modules\panel\controllers;

use app\models\Block;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Block::find()->orderBy(['code' => SORT_ASC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);
    }

    public function actionForm($id)
    {
        $model = $id ? Block::findOne($id) : new Block();

        return $this->renderAjax('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('Block'), 'id');
        $model = $id ? Block::findOne($id) : new Block();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }
}
