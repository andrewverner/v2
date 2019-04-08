<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Order $model
 */

$this->title = Yii::t('app', 'Order #{id}', ['id' => $model->id]);
?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-hand-holding-usd"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app', 'Price') ?></span>
                <span class="info-box-number"><?= $model->price; ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-cogs"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app', 'Status') ?></span>
                <span class="info-box-number"><?= $model->status->title; ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php $tabs = \app\modules\panel\widgets\TabsWidget::begin(); ?>

        <?php $tabs->addTab(Yii::t('app', 'General'), $this->render('_general', [
            'model' => $model,
        ])); ?>
        <?php $tabs->addTab(Yii::t('app', 'Contents'), $this->render('_contents', [
            'model' => $model,
        ])); ?>
        <?php if ($model->user): ?>
            <?php $tabs->addTab(Yii::t('app', 'User'), $this->render('/user/_user-tabs-general', [
                'model' => $model->user,
            ])); ?>
        <?php endif; ?>

        <?php \app\modules\panel\widgets\TabsWidget::end(); ?>
    </div>
    <?php if ($model->deliveryInfo): ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?php \app\modules\panel\widgets\BoxWidget::begin(['title' => Yii::t('app', 'Map')]); ?>
        <?php $map = \app\modules\panel\widgets\YMapWidget::begin(); ?>
        <?php $map->addPlacemark(new \app\modules\panel\widgets\YMapPlacemark(
            $model->deliveryInfo->geo_lat,
            $model->deliveryInfo->geo_lng,
            $model->deliveryInfo->unrestricted_value
        )); ?>
        <?php \app\modules\panel\widgets\YMapWidget::end(); ?>
        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
    <?php endif; ?>
</div>
