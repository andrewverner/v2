<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 11.05.2019
 * Time: 23:35
 */

namespace app\modules\panel\controllers;

use app\components\Controller;
use app\models\ItemCategory;
use yii\web\NotFoundHttpException;

class ItemCategoryController extends Controller
{
    public function actionDrop($id)
    {
        if (!$model = ItemCategory::findOne($id)) {
            throw new NotFoundHttpException(\Yii::t('app', 'Item-Category relation not found'));
        }

        $model->delete();
    }
}