<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

use app\models\Category;
use app\models\Item;
use app\modules\panel\assets\DatePickerAsset;
use app\modules\panel\widgets\ModalWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\panel\widgets\ModalButtonWidget;

DatePickerAsset::register($this);

$this->title = Yii::t('app', 'Promo');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => $this->title]); ?>

        <?php $box->addButton(\yii\helpers\Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new promo'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-loader' => '',
                'data-get-form' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/promo/form'),
                'data-type' => 'get',
                'data-pjax' => '#promo-pjax',
                'data-msg' => Yii::t('app', 'Promo has been saved'),
            ]
        )); ?>

        <?php \yii\widgets\Pjax::begin(['id' => 'promo-pjax']); ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'title',
                'code',
                'discount',
                'active',
                'multiple',
                'expired_at',
                'created',
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\Promo $model
                         */
                        return implode('', [
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="fas fa-edit"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-loader' => '',
                                    'data-get-form' => '',
                                    'data-type' => 'get',
                                    'data-url' => Yii::$app->urlManager->createUrl('/panel/promo/form'),
                                    'data-pjax' => '#promo-pjax',
                                    'data-msg' => Yii::t('app', 'Promo has been saved'),
                                ]
                            ),
                            \yii\helpers\Html::tag(
                                'span',
                                '<i class="far fa-trash-alt"></i>',
                                [
                                    'class' => 'mf-grid-control-btn',
                                    'data-id' => $model->id,
                                    'data-confirm' => Yii::t('app', 'Drop promo {title}?', ['title' => $model->title]),
                                    'data-modal-type' => 'modal-danger',
                                    'data-type' => 'post',
                                    'data-title' => Yii::t('app', 'Delete promo?'),
                                    'data-pjax' => '#promo-pjax',
                                    'data-msg' => Yii::t('app', 'Promo has been dropped'),
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/promo/drop',
                                        'id' => $model->id
                                    ]),
                                ]
                            ),
                            \yii\helpers\Html::tag(
                                'span',
                                Yii::t('app', 'Exceptions'),
                                [
                                    'class' => 'btn btn-sm btn-primary promo-exception-list-btn',
                                    'data-ajax-load' => '',
                                    'data-loader' => '',
                                    'data-url' => Yii::$app->urlManager->createUrl([
                                        '/panel/promo-exception/list',
                                        'id' => $model->id,
                                    ]),
                                    'data-type' => 'get',
                                    'data-target' => '#promo-exception-form-container',
                                    'data-id' => $model->id,
                                ]
                            ),
                        ]);
                    },
                ],
            ],
        ]) ?>

        <?php \yii\widgets\Pjax::end(); ?>

        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ajax-pagination" id="promo-exception-form-container"></div>
</div>

<?php $modal = ModalWidget::begin([
    'title' => Yii::t('app', 'Add items exceptions'),
    'id' => 'exceptions-list-modal',
]) ?>
<?php $modal->addButton(new ModalButtonWidget([
    'title' => Yii::t('app', 'Save'),
    'options' => [
        'class' => 'btn btn-primary',
        'id' => 'submit-exceptions',
        'data-loader' => '',
    ],
])); ?>
<div class="form-group">
    <label><?= Yii::t('app', 'Items') ?></label>
    <?= Select2::widget([
        'name' => 'items',
        'data' => ArrayHelper::map(Item::find()->all(), 'id', 'title'),
        'options' => [
            'multiple' => true,
            'placeholder' => Yii::t('app', 'Select items'),
            'id' => 'items-list',
        ]
    ]); ?>
</div>
<div class="form-group">
    <label><?= Yii::t('app', 'Categories') ?></label>
    <?= Select2::widget([
        'name' => 'size',
        'data' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
        'options' => [
            'multiple' => true,
            'placeholder' => Yii::t('app', 'Select categories'),
            'id' => 'categories-list',
        ]
    ]); ?>
</div>
<?php ModalWidget::end(); ?>

<script>
    $(function () {
        $('#submit-exceptions').click(function () {
            var promoId = $('#promo-id').val();

            $.ajax({
                url: '/panel/promo-exception/add',
                type: 'post',
                data: {
                    items: $('#items-list').val(),
                    categories: $('#categories-list').val(),
                    promoId: promoId
                },
                success: function () {
                    $.alert.success('<?= Yii::t('app', 'Exceptions have been added') ?>');
                    $('#promo-exception-form-container').ajaxReload({
                        url: '/panel/promo-exception/list',
                        type: 'get',
                        data: {
                            id: promoId
                        }
                    });
                    $('#exceptions-list-modal').modal('hide');
                    $('#items-list').val(null).trigger('change');
                    $('#categories-list').val(null).trigger('change');
                },
                error: function(data) {
                    $.alert.error(data.responseText);
                },
                complete: function () {
                    $.loader.hide();
                }
            });
        });
    });
</script>
