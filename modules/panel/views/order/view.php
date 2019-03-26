<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Order $model
 */
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        123
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $tabs = \app\modules\panel\widgets\TabsWidget::begin(); ?>

        <?php $tabs->addTab(Yii::t('app', 'General'), $this->render('_general', [
            'model' => $model,
        ])); ?>

        <?php \app\modules\panel\widgets\TabsWidget::end(); ?>
    </div>
</div>
