<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\panel\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
?>
<div class="page-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $box = \app\modules\panel\widgets\BoxWidget::begin([
                'title' => Yii::t('app', 'Pages')
            ]); ?>

            <?php $box->addButton(Html::a(
                '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new page'),
                Yii::$app->urlManager->createUrl('/panel/page/create'),
                ['class' => 'btn btn-default btn-sm']
            )); ?>

            <?php Pjax::begin(['id' => 'pages-pjax']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'title',
                    'published',
                    'created',
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return implode('', [
                                \yii\helpers\Html::a(
                                    '<i class="fas fa-eye"></i>',
                                    Yii::$app->urlManager->createUrl([
                                        '/panel/page/view',
                                        'id' => $model['id'],
                                    ]),
                                    ['class' => 'mf-grid-control-btn']
                                ),
                                \yii\helpers\Html::a(
                                    '<i class="fas fa-edit"></i>',
                                    Yii::$app->urlManager->createUrl([
                                        '/panel/page/update',
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
                                        'data-confirm' => Yii::t('app', 'Drop page {title}?', ['title' => $model['title']]),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-title' => Yii::t('app', 'Delete page?'),
                                        'data-pjax' => '#pages-pjax',
                                        'data-msg' => Yii::t('app', 'Page has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/page/drop',
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
