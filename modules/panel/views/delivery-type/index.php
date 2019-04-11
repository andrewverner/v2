<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ArrayDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Delivery types');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => $this->title]); ?>

        <?php $box->addButton(\yii\helpers\Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new delivery type'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-loader' => '',
                'data-get-form' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/delivery-type/form'),
                'data-type' => 'get',
                'data-msg' => Yii::t('app', 'Delivery type has been saved'),
                'data-pjax' => '#delivery-type-pjax',
            ]
        )); ?>

        <?php \yii\widgets\Pjax::begin(['id' => 'delivery-type-pjax']); ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'title',
                'active',
                'address_needed',
                'cost',
                'created',
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\DeliveryType $model
                         */
                        return implode('', [
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="fas fa-edit"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-loader' => '',
                                    'data-get-form' => '',
                                    'data-type' => 'get',
                                    'data-url' => Yii::$app->urlManager->createUrl('/panel/delivery-type/form'),
                                    'data-pjax' => '#delivery-type-pjax',
                                    'data-msg' => Yii::t('app', 'Delivery type has been saved'),
                                ]
                            ),
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="far fa-trash-alt"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-confirm' => Yii::t('app', 'Drop delivery type {title}?', ['title' => $model->title]),
                                    'data-modal-type' => 'modal-danger',
                                    'data-type' => 'post',
                                    'data-title' => Yii::t('app', 'Delete delivery type?'),
                                    'data-pjax' => '#delivery-type-pjax',
                                    'data-msg' => Yii::t('app', 'Delivery type has been dropped'),
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/delivery-type/drop',
                                        'id' => $model->id
                                    ]),
                                ]
                            ),
                        ]);
                    },
                ]
            ],
        ]); ?>

        <?php \yii\widgets\Pjax::end(); ?>

        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
