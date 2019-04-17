<?php

use app\models\PickupPoint;
use app\modules\panel\widgets\BoxWidget;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Pickup points');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = BoxWidget::begin(['title' => $this->title]); ?>

        <?php $box->addButton(Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new pickup point'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-loader' => '',
                'data-get-form' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/pickup-point/form'),
                'data-type' => 'get',
                'data-msg' => Yii::t('app', 'Pickup point has been saved'),
                'data-pjax' => '#pickup-point-pjax',
            ]
        )); ?>

        <?php Pjax::begin(['id' => 'pickup-point-pjax']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'address',
                'work_time:html',
                'phone',
                'active',
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /**
                         * @var PickupPoint $model
                         */
                        return implode('', [
                            Html::tag(
                                'span',
                                '<i class="fas fa-edit"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-loader' => '',
                                    'data-get-form' => '',
                                    'data-type' => 'get',
                                    'data-url' => Yii::$app->urlManager->createUrl('/panel/pickup-point/form'),
                                    'data-pjax' => '#pickup-point-pjax',
                                    'data-msg' => Yii::t('app', 'Pickup point has been saved'),
                                ]
                            ),
                            Html::tag(
                                'span',
                                '<i class="far fa-trash-alt"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-confirm' => Yii::t('app', 'Drop pickup point {address}?', ['address' => $model->address]),
                                    'data-modal-type' => 'modal-danger',
                                    'data-type' => 'post',
                                    'data-title' => Yii::t('app', 'Delete pickup point?'),
                                    'data-pjax' => '#pickup-point-pjax',
                                    'data-msg' => Yii::t('app', 'Pickup point has been dropped'),
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/pickup-point/drop',
                                        'id' => $model->id
                                    ]),
                                ]
                            ),
                        ]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

        <?php BoxWidget::end(); ?>
    </div>
</div>
