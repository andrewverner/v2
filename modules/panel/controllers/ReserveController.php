<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.03.19
 * Time: 10:51
 */

namespace app\modules\panel\controllers;

use app\models\Item;
use app\models\ItemReserve;
use app\models\Store;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ReserveController extends Controller
{
    public function init()
    {
        \Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Reserves' => '/panel/reserve',
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Store::find()->orderBy(['title' => SORT_ASC])->all(),
                'pagination' => [
                    'pageSize' => 25,
                ],
            ]),
        ]);
    }

    public function actionForm($itemId = null, $id = null)
    {
        if (!$item = Item::findOne($itemId)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Item not found'));
        }

        $model = $id ? ItemReserve::findOne($id) : new ItemReserve();
        if ($model->isNewRecord) {
            $model->item_id = $item->id;
        }
        $stores = ArrayHelper::map(Store::find()->orderBy(['title' => SORT_ASC])->all(), 'id', 'title');
        if ($sizeRels = $item->sizeRels) {
            $sizes = [];
            foreach ($sizeRels as $sizeRel) {
                $sizes[$sizeRel->size->id] = $sizeRel->size->value;
            }
        }

        return $this->renderPartial('_form', [
            'model' => $model,
            'stores' => $stores,
            'sizes' => $sizes ?? [],
        ]);
    }

    public function actionSave()
    {
        $id = ArrayHelper::getValue(\Yii::$app->request->post('ItemReserve'), 'id');
        $model = $id ? ItemReserve::findOne($id) : new ItemReserve();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    public function actionDrop($id)
    {
        if (!$model = ItemReserve::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Reserve not found'));
        }

        $model->delete();
    }
}
