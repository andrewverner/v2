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
        <?php \yii\widgets\Pjax::begin(['id' => 'order-status-pjax']); ?>
        <div class="info-box" id="order-status-box" data-id="<?= $model->id ?>" data-loader>
            <span class="info-box-icon" style="background-color: <?= $model->status->color; ?>"><i class="fas fa-cogs"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app', 'Status') ?></span>
                <span class="info-box-number"><?= $model->status->title; ?></span>
            </div>
        </div>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
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
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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

<?php \app\modules\panel\widgets\ModalWidget::begin([
    'title' => Yii::t('app', 'Change status'),
    'id' => 'status-flow-modal',
]); ?>
<div id="order-status-flow-container"></div>
<?php \app\modules\panel\widgets\ModalWidget::end(); ?>

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
