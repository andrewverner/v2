<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2Asset;

Select2Asset::register($this);

$this->title = Yii::t('app', 'Item properties');

?>
<div class="property-index">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <?php $box = \app\modules\panel\widgets\BoxWidget::begin([
                'title' => Yii::t('app', 'Item properties')
            ]); ?>

            <?php $box->addButton(\yii\helpers\Html::tag(
                'span',
                '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new property'),
                [
                    'data-get-form' => '',
                    'data-type' => 'post',
                    'data-url' => Yii::$app->urlManager->createUrl('/panel/property/form'),
                    'data-pjax' => '#property-pjax',
                    'data-msg' => Yii::t('app', 'Property has been saved'),
                    'class' => 'btn btn-default btn-sm',
                ]
            )); ?>

            <?php Pjax::begin(['id' => 'property-pjax']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'title',
                    'multiple',
                    'filterable',
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
                                        'data-type' => 'post',
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/property/form',
                                            'id' => $model['id'],
                                        ]),
                                        'data-pjax' => '#property-pjax',
                                        'data-msg' => Yii::t('app', 'Property has been saved'),
                                    ]
                                ),
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="far fa-trash-alt"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-id' => $model['id'],
                                        'data-confirm' => Yii::t('app', 'Drop property {title}? This action will cause deleting of all corresponding property values and item property relations.', ['title' => $model['title']]),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-title' => Yii::t('app', 'Delete property?'),
                                        'data-pjax' => '#property-pjax',
                                        'data-msg' => Yii::t('app', 'Property has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/property/drop',
                                            'id' => $model['id']
                                        ]),
                                    ]
                                ),
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="fas fa-list-ul"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-ajax-load' => '',
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/property-value/list',
                                            'propertyId' => $model['id'],
                                        ]),
                                        'data-type' => 'get',
                                        'data-target' => '#value-list-container',
                                    ]
                                ),
                            ]);
                        },
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?>

            <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="value-list-container"></div>
    </div>
</div>
