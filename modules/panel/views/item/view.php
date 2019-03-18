<?php

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var \app\modules\panel\models\UploadModel $uploadModel */

use app\modules\panel\assets\ItemAsset;
ItemAsset::register($this);

$this->title = $model->title;
\yii\web\YiiAsset::register($this);

$this->params['breadcrumbs'][$model->title] = Yii::$app->urlManager->createUrl([
    '/panel/item/view',
    'id' => $model->id,
])
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $tabs = \app\modules\panel\widgets\TabsWidget::begin(); ?>
        <?php $tabs->addTab(
            Yii::t('app', 'General'),
            $this->render('tabs-general', ['model' => $model])
        ); ?>
        <?php $tabs->addTab(
            Yii::t('app', 'Categories'),
            $this->render('tabs-categories', ['model' => $model])
        ); ?>
        <?php $tabs->addTab(
            Yii::t('app', 'Sizes'),
            $this->render('tabs-sizes', ['model' => $model])
        ); ?>
        <?php $tabs->addTab(
            Yii::t('app', 'Properties'),
            $this->render('tabs-properties', ['model' => $model])
        ); ?>
        <?php $tabs->addTab(
            Yii::t('app', 'Images'),
            $this->render('tabs-images', ['model' => $model, 'uploadModel' => $uploadModel])
        ); ?>
        <?php \app\modules\panel\widgets\TabsWidget::end(); ?>
    </div>
</div>
