<?php

use yii\helpers\Html;
use app\modules\panel\assets\ItemAsset;

ItemAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var \app\modules\panel\models\UploadModel $uploadModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => 'General',
                'content' => $this->render('tabs-general', ['model' => $model]),
            ],
            [
                'label' => 'Categories',
                'content' => $this->render('tabs-categories', ['model' => $model]),
                'visible' => !$model->isNewRecord,
            ],
            [
                'label' => 'Sizes',
                'content' => $this->render('tabs-sizes', ['model' => $model]),
                'visible' => !$model->isNewRecord,
            ],
            [
                'label' => 'Images',
                'content' => $this->render('tabs-images', ['model' => $model, 'uploadModel' => $uploadModel]),
                'visible' => !$model->isNewRecord,
            ],
        ],
    ]); ?>

</div>
