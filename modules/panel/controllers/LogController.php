<?php

namespace app\modules\panel\controllers;

use app\models\Log;
use yii\data\ActiveDataProvider;

class LogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Log::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 25,
            ]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
