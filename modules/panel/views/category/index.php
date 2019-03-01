<?php
/**
 * @var $this yii\web\View
 * @var $searchModel app\models\CategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\panel\assets\CategoryAsset;
use kartik\select2\Select2Asset;

Select2Asset::register($this);
CategoryAsset::register($this);

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
                            <span class="btn btn-default btn-sm" id="new-category">
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
                            'value' => function ($category) {
                                return implode('', [
                                    \yii\helpers\Html::tag(
                                        'span',
                                        '<i class="fas fa-edit"></i>',
                                        [
                                            'class' => 'mf-grid-control-btn edit-category',
                                            'data-id' => $category['id'],
                                            'data-loader' => '',
                                        ]
                                    ),
                                    \yii\helpers\Html::tag(
                                        'span',
                                        '<i class="far fa-trash-alt"></i>',
                                        [
                                            'class' => 'mf-grid-control-btn delete-category',
                                            'data-id' => $category['id'],
                                            'data-confirm' => Yii::t('app', 'Drop category {name}?', ['name' => $category['name']]),
                                            'data-class' => 'modal-danger',
                                            'data-type' => 'post',
                                            'data-title' => Yii::t('app', 'Удалить категорию?'),
                                            'data-pjax' => '#categories-pjax',
                                            'data-message' => Yii::t('app', 'Category has been dropped'),
                                            'data-url' => Yii::$app->urlManager->createUrl([
                                                '/panel/category/drop',
                                                'id' => $category['id']
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

<?php \app\modules\panel\widgets\ModalWidget::begin([
    'title' => Yii::t('app', 'Category'),
    'id' => 'category-form-modal',
    'buttons' => [
        new \app\modules\panel\widgets\ModalButtonWidget([
            'title' => Yii::t('app', 'Cancel'),
            'options' => [
                'data-dismiss' => 'modal',
                'class' => 'btn pull-left',
            ],
        ]),
        new \app\modules\panel\widgets\ModalButtonWidget([
            'title' => Yii::t('app', 'Save'),
            'options' => [
                'class' => 'btn btn-primary',
                'id' => 'save-category-btn',
                'data-loader' => '',
            ],
        ]),
    ],
]); ?>
<p id="category-form-container">

</p>
<?php \app\modules\panel\widgets\ModalWidget::end(); ?>
