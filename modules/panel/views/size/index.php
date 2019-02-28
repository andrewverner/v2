<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\panel\assets\SizeAsset;
use kartik\select2\Select2Asset;

Select2Asset::register($this);
SizeAsset::register($this);

$this->title = Yii::t('app', 'Sizes');

?>
<div class="size-index">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Sizes'); ?></h3>
                    <div class="box-tools text-right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-btn">
                                <span class="btn btn-default btn-sm" id="new-model">
                                    <i class="fas fa-plus"></i> <?= Yii::t('app', 'Add size'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <?php Pjax::begin(['id' => 'sizes-pjax']); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'value',
                            'created',
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \app\modules\panel\widgets\ModalWidget::begin([
    'title' => Yii::t('app', 'Size'),
    'id' => 'model-form-modal',
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
                'id' => 'save-model-btn',
                'data-loader' => '',
            ],
        ]),
    ],
]); ?>
<p id="model-form-container">

</p>
<?php \app\modules\panel\widgets\ModalWidget::end(); ?>
