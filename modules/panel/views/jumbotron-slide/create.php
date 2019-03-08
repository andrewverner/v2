<?php

/* @var $this yii\web\View */
/* @var $model app\models\JumbotronSlide */
$this->params['breadcrumbs']['New jumbotron slide'] = '/panel/jumbotron-slide/create';
$this->title = Yii::t('app', 'New jumbotron slide');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php \app\modules\panel\widgets\BoxWidget::begin(['title' => Yii::t('app', 'New jumbotron slide')]); ?>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
