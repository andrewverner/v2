<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = Yii::t('app', 'Update Page: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][$model->title] = Yii::$app->urlManager->createUrl([
    '/panel/page/update',
    'id' => $model->id,
]);
?>
<div class="page-update">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php \app\modules\panel\widgets\BoxWidget::begin([
                'title' => $model->title,
            ]); ?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
        </div>
    </div>
</div>
