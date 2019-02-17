<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\panel\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Images');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="img-thumbnail" style="background-image: url(<?= $model->source ?>)">
                <span class="drop-image btn btn-danger" data-id="<?= $model->id ?>"><i class="fas fa-trash-alt"></i></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php Pjax::end(); ?>
</div>
