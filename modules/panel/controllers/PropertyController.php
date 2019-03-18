<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.03.19
 * Time: 15:19
 */

namespace app\modules\panel\controllers;

use app\models\ItemProperty;
use app\models\ItemPropertyValue;
use app\models\ItemPropertyValueRel;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PropertyController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => ItemProperty::find(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm($id = null)
    {
        $model = $id ? ItemProperty::findOne($id) : new ItemProperty();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('ItemProperty'), 'id');
        $model = $id ? ItemProperty::findOne($id) : new ItemProperty();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        /*if (!$model = ItemProperty::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Property not found'));
        }

        $transation = \Yii::$app->db->beginTransaction();
        try {
            $propertyValuesIds = ItemPropertyValue::findAll(['property_id' => $model->id]);

            $model->delete();

            $transation->commit();
        } catch (\Throwable $exception) {
            $transation->rollBack();
        }*/
    }
}
