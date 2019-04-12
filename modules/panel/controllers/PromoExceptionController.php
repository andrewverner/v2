<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.04.19
 * Time: 9:33
 */

namespace app\modules\panel\controllers;

use app\models\Promo;
use app\models\PromoException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PromoExceptionController extends Controller
{
    public function actionList($id)
    {
        if (!$model = Promo::findOne($id)) {
            throw new  NotFoundHttpException(\Yii::t('app', 'Promo not found'));
        }

        return $this->renderPartial('_list', [
            'dataProvider' => new ActiveDataProvider([
                'query' => PromoException::find()->where(['promo_id' => $model->id]),
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]),
            'model' => $model,
        ]);
    }

    public function actionForm($id = null)
    {
        $model = $id ? PromoException::findOne($id) : new PromoException();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    public function actionAdd()
    {
        $promoId = \Yii::$app->request->post('promoId');
        if (!$promoId || !$promo = Promo::findOne($promoId)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Promo not found'));
        }

        $items = \Yii::$app->request->post('items');
        $categories = \Yii::$app->request->post('categories');
        if (!$items && !$categories) {
            throw new BadRequestHttpException(\Yii::t('app', 'Invalid data'));
        }

        if ($items) {
            foreach ($items as $itemId) {
                $params = [
                    'promo_id' => $promoId,
                    'entity_type' => PromoException::ENTITY_TYPE_ITEM,
                    'entity_id' => $itemId
                ];
                if (PromoException::find()->where($params)->exists()) {
                    continue;
                }

                $model = new PromoException();
                $model->entity_id = $itemId;
                $model->entity_type = PromoException::ENTITY_TYPE_ITEM;
                $model->promo_id = $promoId;
                $model->save();
            }
        }

        if ($categories) {
            foreach ($categories as $categoryId) {
                $params = [
                    'promo_id' => $promoId,
                    'entity_type' => PromoException::ENTITY_TYPE_CATEGORY,
                    'entity_id' => $categoryId
                ];
                if (PromoException::find()->where($params)->exists()) {
                    continue;
                }

                $model = new PromoException();
                $model->entity_id = $categoryId;
                $model->entity_type = PromoException::ENTITY_TYPE_CATEGORY;
                $model->promo_id = $promoId;
                $model->save();
            }
        }
    }
}
