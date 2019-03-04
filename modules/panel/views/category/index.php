<?php
/**
 * @var $this yii\web\View
 * @var $searchModel app\models\CategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2Asset;

Select2Asset::register($this);

$this->title = Yii::t('app', 'Categories');
?>
<div class="category-index">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('app', 'Categories'); ?></h3>
                <div class="box-tools text-right">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="input-group-btn">
                            <span class="btn btn-default btn-sm" data-get-form data-type="post" data-pjax="#categories-pjax"
                                data-url="<?= Yii::$app->urlManager->createUrl('/panel/category/form'); ?>"
                                data-msg="<?= Yii::t('app', 'Category has been saved'); ?>">
                                <i class="fas fa-plus"></i> <?= Yii::t('app', 'Add category'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <?php Pjax::begin(['id' => 'categories-pjax']); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'name',
                        'depth',
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return implode('', [
                                    \yii\helpers\Html::tag(
                                        'span',
                                        '<i class="fas fa-edit"></i>',
                                        [
                                            'class' => 'mf-grid-control-btn edit-category',
                                            'data-id' => $model['id'],
                                            'data-loader' => '',
                                            'data-get-form' => '',
                                            'data-url' => Yii::$app->urlManager->createUrl('/panel/category/form'),
                                            'data-type' => 'post',
                                            'data-pjax' => '#categories-pjax',
                                            'data-msg' => Yii::t('app', 'Category has been saved'),
                                        ]
                                    ),
                                    \yii\helpers\Html::tag(
                                        'span',
                                        '<i class="far fa-trash-alt"></i>',
                                        [
                                            'class' => 'mf-grid-control-btn delete-category',
                                            'data-id' => $model['id'],
                                            'data-confirm' => Yii::t('app', 'Drop category {name}?', ['name' => $model['name']]),
                                            'data-modal-type' => 'modal-danger',
                                            'data-type' => 'post',
                                            'data-title' => Yii::t('app', 'Удалить категорию?'),
                                            'data-pjax' => '#categories-pjax',
                                            'data-msg' => Yii::t('app', 'Category has been dropped'),
                                            'data-url' => Yii::$app->urlManager->createUrl([
                                                '/panel/category/drop',
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
