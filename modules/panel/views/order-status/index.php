<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\OrderStatus[] $models
 */

use app\modules\panel\assets\SpectrumAsset;
SpectrumAsset::register($this);

$this->title = Yii::t('app', 'Order statuses');
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => $this->title]); ?>

        <?php $box->addButton(\yii\helpers\Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new order status'),
            [
                'data-get-form' => '',
                'data-loader' => '',
                'data-type' => 'post',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/order-status/form'),
                'data-pjax' => '#status-pjax',
                'data-msg' => Yii::t('app', 'Order status has been saved'),
                'class' => 'btn btn-primary btn-sm',
            ]
        )); ?>

        <?php \yii\widgets\Pjax::begin(['id' => 'status-pjax']); ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $models,
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]),
            'columns' => [
                'id',
                'title',
                'description',
                'is_final',
                [
                    'label' => Yii::t('app', 'Color'),
                    'format' => 'html',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\OrderStatus $model
                         */
                        return \yii\helpers\Html::tag('div', null, [
                            'class' => 'order-status-color-box',
                            'style' => "background-color: {$model->color}",
                        ]);
                    }
                ],
                [
                    'label' => Yii::t('app', 'Can change to'),
                    'format' => 'html',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\OrderStatus $model
                         * @var \app\models\OrderStatusFlow[] $availableStatuses
                         */
                        $availableStatuses = array_merge($model->prevStatuses, $model->nextStatuses);
                        if (!$availableStatuses) {
                            return;
                        }

                        foreach ($availableStatuses as &$availableStatus) {
                            $availableStatus = \yii\helpers\Html::tag('span', $availableStatus->status->title, [
                                'class' => "order-status-bulge dir-{$availableStatus->direction}",
                                'style' => "background-color: {$availableStatus->status->color}",
                            ]);
                        }

                        return implode(' ', $availableStatuses);
                    }
                ],
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\OrderStatus $model
                         */
                        return implode('', [
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="fas fa-sitemap"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-ajax-load' => '',
                                    'data-loader' => '',
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/order-status/flow-form',
                                        'id' => $model->id,
                                    ]),
                                    'data-type' => 'get',
                                    'data-target' => '#order-status-flow-form-container',
                                ]
                            ),
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="fas fa-edit"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-loader' => '',
                                    'data-get-form' => '',
                                    'data-type' => 'post',
                                    'data-url' => Yii::$app->urlManager->createUrl('/panel/order-status/form'),
                                    'data-pjax' => '#status-pjax',
                                    'data-msg' => Yii::t('app', 'Order status has been saved'),
                                ]
                            ),
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="far fa-trash-alt"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-confirm' => Yii::t('app', 'Drop order status {title}?', ['title' => $model->title]),
                                    'data-modal-type' => 'modal-danger',
                                    'data-type' => 'post',
                                    'data-title' => Yii::t('app', 'Delete order status?'),
                                    'data-pjax' => '#status-pjax',
                                    'data-msg' => Yii::t('app', 'Order status has been dropped'),
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/order-status/drop',
                                        'id' => $model['id']
                                    ]),
                                ]
                            ),
                        ]);
                    },
                ]
            ]
        ]); ?>

        <?php \yii\widgets\Pjax::end(); ?>

        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>

    <div class="col-lg-6 col-md-9 col-sm-12 col-xs-12" id="order-status-flow-form-container"></div>
</div>

<script>
    $(document).on('click', '.flow-checkbox', function () {
        var $el = $(this),
            elId = $el.data('id'),
            checkDir = parseInt($el.data('direction')) === 1 ? 2 : 1,
            checkSelector = '.flow-checkbox[data-id=' + elId + '][data-direction=' + checkDir + ']';
        if ($(checkSelector).prop('checked')) {
            $(checkSelector).prop('checked', false);
        }
    });

    $(document).on('click', '#save-order-flow', function () {
        var data = [];
        $('.flow-checkbox').each(function (index, node)  {
            if ($(node).prop('checked')) {
                data.push({
                    id: $(node).data('id'),
                    direction: $(node).data('direction')
                });
            }
        });

        $.ajax({
            url: '/panel/order-status/save-flow',
            type: 'post',
            data: {
                id: $(this).data('id'),
                data: data
            },
            success: function () {
                $('#order-status-flow-form').fadeOut('fast');
                $.alert.success('<?= Yii::t('app', 'Flow has been saved') ?>');
                $.pjax.reload({container: '#status-pjax'});
            },
            error: function (data) {
                $.alert.error(data.responseText);
            },
            complete: function () {
                $.loader.hide();
            }
        });
    });
</script>
