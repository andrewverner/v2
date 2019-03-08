<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2Asset;

Select2Asset::register($this);

$this->title = Yii::t('app', 'Jumbotron slides');
?>
<div class="size-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Jumbotron slides'); ?></h3>
                    <div class="box-tools text-right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-btn">
                                <?= \yii\helpers\Html::a(
                                    '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add jumbotron slide'),
                                    Yii::$app->urlManager->createUrl('/panel/jumbotron-slide/create'),
                                    ['class' => 'btn btn-primary btn-sm']
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <?php Pjax::begin(['id' => 'jumbotron-pjax']); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'title',
                            'active',
                            [
                                'label' => '',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return implode('', [
                                        /*\yii\helpers\Html::tag(
                                            'span',
                                            '<i class="fas fa-edit"></i>',
                                            [
                                                'class' => 'mf-grid-control-btn',
                                                'data-id' => $model['id'],
                                                'data-loader' => '',
                                                'data-get-form' => '',
                                                'data-type' => 'post',
                                                'data-url' => Yii::$app->urlManager->createUrl('/panel/size/form'),
                                                'data-pjax' => '#sizes-pjax',
                                                'data-msg' => Yii::t('app', 'Size has been saved'),
                                            ]
                                        ),*/
                                        \yii\helpers\Html::tag(
                                            'span',
                                            '<i class="far fa-trash-alt"></i>',
                                            [
                                                'class' => 'mf-grid-control-btn',
                                                'data-id' => $model['id'],
                                                'data-confirm' => Yii::t('app', 'Drop slide {title}?', ['title' => $model['title']]),
                                                'data-modal-type' => 'modal-danger',
                                                'data-type' => 'post',
                                                'data-title' => Yii::t('app', 'Delete slide?'),
                                                'data-pjax' => '#jumbotron-pjax',
                                                'data-msg' => Yii::t('app', 'Slide has been dropped'),
                                                'data-url' => Yii::$app->urlManager->createUrl([
                                                    '/panel/jumbotron-slide/drop',
                                                    'id' => $model['id']
                                                ]),
                                            ]
                                        ),
                                    ]);
                                },
                            ]
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
