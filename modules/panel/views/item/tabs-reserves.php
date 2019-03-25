<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:22
 *
 * @var \app\models\Item $model
 */
?>
<div>
    <?php \yii\widgets\Pjax::begin(['id' => 'reserve-pjax']); ?>
    <?php if (!\app\models\Store::find()->exists()): ?>
        <div class="alert alert-info">
            <?= Yii::t('app', 'There are no stores yet. Please {add} a store in order to manage items reserves', [
                'add' => \yii\helpers\Html::tag('span', Yii::t('app', 'add'), [
                    'data-get-form' => '',
                    'data-loader' => '',
                    'data-url' => Yii::$app->urlManager->createUrl('/panel/store/form'),
                    'data-type' => 'post',
                    'data-pjax' => '#reserve-pjax',
                    'data-msg' => Yii::t('app', 'Store has been saved'),
                    'class' => 'btn btn-primary btn-sm',
                ]),
            ]); ?>
        </div>
    <?php else: ?>
        <div class="text-right">
            <?= \yii\helpers\Html::tag(
            'span',
                '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add reserve'),
                [
                    'data-get-form' => '',
                    'data-loader' => '',
                    'data-url' => Yii::$app->urlManager->createUrl([
                        '/panel/reserve/form',
                        'itemId' => $model->id,
                    ]),
                    'data-type' => 'post',
                    'data-pjax' => '#reserve-pjax',
                    'data-msg' => Yii::t('app', 'Data has been saved'),
                    'class' => 'btn btn-primary btn-sm',
                ]
            ) ?>
        </div>
    <?php endif; ?>
    <?php if (!$model->reserves): ?>
        <div class="alert alert-info margin-top">
            <?= Yii::t('app', 'Item has no reserves yet'); ?>
        </div>
    <?php else: ?>
        <div class="margin-top">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $model->reserves,
                    'pagination' => [
                        'pageSize' => 25,
                    ],
                ]),
                'columns' => [
                    [
                        'label' => Yii::t('app', 'Store'),
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemReserve $rel
                             */
                            return $rel->store->title;
                        }
                    ],
                    [
                        'label' => 'Quantity',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemReserve $rel
                             */
                            return $rel->quantity;
                        }
                    ],
                    [
                        'label' => '',
                        'value' => function ($rel) {
                            return implode('', [
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="fas fa-edit pointer"></i>',
                                    [
                                        'data-get-form' => '',
                                        'data-loader' => '',
                                        'data-url' => Yii::$app->urlManager->createUrl('/panel/reserve/form'),
                                        'data-type' => 'get',
                                        'data-id' => $rel->id,
                                        'data-pjax' => '#reserve-pjax',
                                        'data-msg' => Yii::t('app', 'Data has been saved'),
                                        'class' => 'mf-grid-control-btn',
                                    ]
                                ),
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="fas fa-trash-alt pointer"></i>',
                                    [
                                        'data-confirm' => Yii::t('app', 'Drop reserve?'),
                                        'data-modal-type' => 'modal-danger',
                                        'data-pjax' => '#reserve-pjax',
                                        'data-type' => 'post',
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/reserve/drop',
                                            'id' => $rel->id,
                                        ]),
                                        'data-msg' => Yii::t('app', 'Reserve has been dropped'),
                                        'data-title' => Yii::t('app', 'Drop reserve?'),
                                        'class' => 'mf-grid-control-btn',
                                    ]
                                ),
                            ]);
                        },
                        'format' => 'raw',
                    ]
                ]
            ]); ?>
        </div>
    <?php endif; ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>