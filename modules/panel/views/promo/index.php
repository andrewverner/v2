<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

use app\modules\panel\assets\DatePickerAsset;
DatePickerAsset::register($this);

$this->title = Yii::t('app', 'Promo');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => $this->title]); ?>

        <?php $box->addButton(\yii\helpers\Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new promo'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-loader' => '',
                'data-get-form' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/promo/form'),
                'data-type' => 'get',
                'data-pjax' => '#promo-pjax',
                'data-msg' => Yii::t('app', 'Promo has been saved'),
            ]
        )); ?>

        <?php \yii\widgets\Pjax::begin(['id' => 'promo-pjax']); ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'title',
                'code',
                'discount',
                'active',
                'multiple',
                'expired_at',
                'created',
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\Promo $model
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
                                    'data-url' => Yii::$app->urlManager->createUrl('/panel/promo/form'),
                                    'data-pjax' => '#promo-pjax',
                                    'data-msg' => Yii::t('app', 'Promo has been saved'),
                                ]
                            ),
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="far fa-trash-alt"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-confirm' => Yii::t('app', 'Drop promo {title}?', ['title' => $model->title]),
                                    'data-modal-type' => 'modal-danger',
                                    'data-type' => 'post',
                                    'data-title' => Yii::t('app', 'Delete promo?'),
                                    'data-pjax' => '#promo-pjax',
                                    'data-msg' => Yii::t('app', 'Promo has been dropped'),
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/promo/drop',
                                        'id' => $model->id
                                    ]),
                                ]
                            ),
                        ]);
                    },
                ],
            ],
        ]) ?>

        <?php \yii\widgets\Pjax::end(); ?>

        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
