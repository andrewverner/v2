<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2Asset;

Select2Asset::register($this);

$this->title = Yii::t('app', 'Pixels & counters');

?>
<div class="seo-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $box = \app\modules\panel\widgets\BoxWidget::begin([
                'title' => Yii::t('app', 'Pixels & counters'),
            ]); ?>

            <?php $box->addButton(\yii\helpers\Html::tag(
                'span',
                '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new pixel or counter'),
                [
                    'class' => 'btn btn-default btn-sm',
                    'data-get-form' => '',
                    'data-loader' => '',
                    'data-url' => Yii::$app->urlManager->createUrl('/panel/counter/form'),
                    'data-type' => 'post',
                    'data-msg' => Yii::t('app', 'Data has been saved'),
                    'data-pjax' => '#counter-pjax',
                ]
            )); ?>

            <?php Pjax::begin(['id' => 'counter-pjax']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'title',
                    'active',
                    'is_external',
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
                                        'data-url' => Yii::$app->urlManager->createUrl('/panel/counter/form'),
                                        'data-pjax' => '#counter-pjax',
                                        'data-msg' => Yii::t('app', 'Record has been saved'),
                                    ]
                                ),
                                \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="far fa-trash-alt"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-id' => $model['id'],
                                        'data-confirm' => Yii::t('app', 'Drop counter or pixel {title}?', ['title' => $model['title']]),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-title' => Yii::t('app', 'Delete record?'),
                                        'data-pjax' => '#counter-pjax',
                                        'data-msg' => Yii::t('app', 'Record has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/counter/drop',
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

            <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
        </div>
    </div>
</div>
