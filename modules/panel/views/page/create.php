<?php

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = Yii::t('app', 'Create Page');
$this->params['breadcrumbs']['New page'] = Yii::$app->urlManager->createUrl('/panel/page/create');
?>
<div class="page-create">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php \app\modules\panel\widgets\BoxWidget::begin([
                'title' => Yii::t('app', 'New page')
            ]) ?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <?php \app\modules\panel\widgets\BoxWidget::end() ?>
        </div>
    </div>
</div>
