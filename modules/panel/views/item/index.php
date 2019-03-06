<?php

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\modules\panel\models\ItemSearch $searchModel
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Items');
?>
<div class="item-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => Yii::t('app', 'Items')]);  ?>
            <?php $box->addButton(
                Html::a(
                    '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add item'),
                    Yii::$app->urlManager->createUrl('/panel/item/create'),
                    ['class' => 'btn btn-default btn-sm']
                )
            ); ?>

            <?php Pjax::begin(['id' => 'items-pjax']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'label' => Yii::t('app', 'Title'),
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a($model['title'], Yii::$app->urlManager->createUrl([
                                '/panel/item/view',
                                'id' => $model['id'],
                            ]));
                        }
                    ],
                    'price',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return implode('', [
                                \yii\helpers\Html::a(
                                    '<i class="fas fa-edit"></i>',
                                    Yii::$app->urlManager->createUrl([
                                        '/panel/item/update',
                                        'id' => $model['id'],
                                    ]),
                                    ['class' => 'mf-grid-control-btn']
                                ),
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="far fa-trash-alt"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-id' => $model['id'],
                                        'data-confirm' => Yii::t('app', 'Drop item {title}?', ['title' => $model['title']]),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-title' => Yii::t('app', 'Delete item?'),
                                        'data-pjax' => '#items-pjax',
                                        'data-msg' => Yii::t('app', 'Item has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/item/drop',
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
