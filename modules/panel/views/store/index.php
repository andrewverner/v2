<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stores');
?>
<div class="store-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $box = \app\modules\panel\widgets\BoxWidget::begin([
                'title' => Yii::t('app', 'Stores')
            ]); ?>

            <?php $box->addButton(\yii\helpers\Html::tag(
                'span',
                '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new store'),
                [
                    'class' => 'btn btn-default btn-sm',
                    'data-get-form' => '',
                    'data-loader' => '',
                    'data-url' => Yii::$app->urlManager->createUrl('/panel/store/form'),
                    'data-type' => 'post',
                    'data-msg' => Yii::t('app', 'Store has been saved'),
                    'data-pjax' => '#stores-pjax',
                ]
            )); ?>

            <?php Pjax::begin(['id' => 'stores-pjax']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'title',
                    'created',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return implode('', [
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="fas fa-edit"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-id' => $model['id'],
                                        'data-loader' => '',
                                        'data-get-form' => '',
                                        'data-type' => 'get',
                                        'data-url' => Yii::$app->urlManager->createUrl('/panel/store/form'),
                                        'data-pjax' => '#stores-pjax',
                                        'data-msg' => Yii::t('app', 'Store has been saved'),
                                    ]
                                ),
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="far fa-trash-alt"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-id' => $model['id'],
                                        'data-confirm' => Yii::t('app', 'Drop store {title}?', ['title' => $model['title']]),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-title' => Yii::t('app', 'Delete store?'),
                                        'data-pjax' => '#stores-pjax',
                                        'data-msg' => Yii::t('app', 'Store has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/store/drop',
                                            'id' => $model['id']
                                        ]),
                                    ]
                                ),
                            ]);
                        }
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?>


            <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
        </div>
    </div>
</div>
