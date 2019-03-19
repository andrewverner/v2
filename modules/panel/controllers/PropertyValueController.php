<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.03.19
 * Time: 16:37
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

class PropertyValueController extends Controller
{
    public function actionList($propertyId)
    {
        if (!$model = ItemProperty::findOne($propertyId)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Property not found'));
        }

        return $this->renderPartial('_list', [
            'model' => $model,
            'dataProvider' => new ActiveDataProvider([
                'query' => ItemPropertyValue::find()->where(['property_id' => $model->id])->orderBy(['value' => SORT_ASC]),
                'pagination' => [
                    'pageSize' => 250,
                ],
            ]),
        ]);
    }

    public function actionForm($propertyId = null, $id = null)
    {
        $model = $id ? ItemPropertyValue::findOne($id) : new ItemPropertyValue();
        if ($model->isNewRecord) {
            $model->property_id = $propertyId;
        }

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('ItemPropertyValue'), 'id');
        $model = $id ? ItemPropertyValue::findOne($id) : new ItemPropertyValue();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = ItemPropertyValue::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Size not found'));
        }

        ItemPropertyValueRel::deleteAll(['property_value_id' => $model->id]);

        $model->delete();
    }

    public function actionValue($propertyId)
    {
        if (!$model = ItemProperty::findOne($propertyId)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Property not found'));
        }

        return $this->renderPartial('_value', [
            'property' => $model,
            'models' => ItemPropertyValue::find()->where(['property_id' => $model->id])->orderBy(['value' => SORT_ASC])->all()
        ]);
    }
}
