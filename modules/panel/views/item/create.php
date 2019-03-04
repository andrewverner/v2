<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
$this->params['breadcrumbs'][Yii::t('app', 'New item')] = Yii::$app->urlManager->createUrl('/panel/item/create');
$this->title = Yii::t('app', 'New Item');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php \app\modules\panel\widgets\BoxWidget::begin(['title' => Yii::t('app', 'New item')]); ?>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
