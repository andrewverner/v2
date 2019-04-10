<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Order $model
 */

$this->title = Yii::t('app', 'Order #{id}', ['id' => $model->id]);

$this->params['breadcrumbs'][$model->id] = Yii::$app->urlManager->createUrl([
    '/panel/order/view',
    'id' => $model->id,
]);
?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-hand-holding-usd"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app', 'Price') ?></span>
                <span class="info-box-number"><?= $model->price; ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
</div>

<script>
    $(function () {
        $(document).on('click', '#order-status-box', function () {
            $.ajax({
                url: '/panel/order/status-flow',
                type: 'post',
                data: {
                    id: $(this).data('id')
                },
                success: function (data) {
                    $('#order-status-flow-container').html(data);
                    $('#status-flow-modal').modal('show');
                },
                error: function (data) {
                    $.alert.error(data.responseText);
                },
                complete: function () {
                    $.loader.hide();
                }
            });
        });

        $(document).on('click', '.order-status-flow li', function () {
            $.ajax({
                url: '/panel/order/change-status',
                type: 'post',
                data: {
                    id: <?= $model->id ?>,
                    status: $(this).data('id')
                },
                success: function () {
                    $.pjax.reload({container: '#order-status-pjax'});
                    $('#status-flow-modal').modal('hide');
                },
                error: function (data) {
                    $.alert.error(data.responseText);
                },
                complete: function () {
                    $.loader.hide();
                }
            });
        });
    });
</script>
