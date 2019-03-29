<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:22
 *
 * @var \app\models\Item $model
 */
?>
<div>
    <p class="text-right">
        <span id="add-property" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> <?= Yii::t('app', 'Add property'); ?>
        </span>
    </p>
    <?php \yii\widgets\Pjax::begin(['id' => 'property-pjax']); ?>
    <?php if (!$model->sizeRels): ?>
        <div class="alert alert-info margin-top">
            <?= Yii::t('app', 'Item has no sizes yet'); ?>
        </div>
    <?php else: ?>
    <div class="margin-top">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $model->propertyRels,
                'pagination' => [
                    'pageSize' => 150,
                ],
            ]),
            'columns' => [
                [
                    'label' => 'Property',
                    'value' => function ($rel) {
                        /**
                         * @var $rel \app\models\ItemPropertyValueRel
                         */
                        return $rel->propertyValue->property->title;
                    }
                ],
                [
                    'label' => 'Value',
                    'value' => function ($rel) {
                        /**
                         * @var $rel \app\models\ItemPropertyValueRel
                         */
                        return $rel->propertyValue->value;
                    }
                ],
                [
                    'label' => '',
                    'value' => function ($rel) {
                        /**
                         * @var $rel \app\models\ItemPropertyValueRel
                         */
                        return \yii\helpers\Html::tag(
                            'span',
                            '<i class="fas fa-trash-alt pointer"></i>',
                            [
                                'data-confirm' => Yii::t('app', 'Drop property value "{property}: {value}"?', [
                                    'property' => $rel->propertyValue->property->title,
                                    'value' => $rel->propertyValue->value,
                                ]),
                                'data-modal-type' => 'modal-danger',
                                'data-title' => Yii::t('app', 'Drop property value?'),
                                'data-pjax' => '#property-pjax',
                                'data-type' => 'post',
                                'data-url' => Yii::$app->urlManager->createUrl([
                                    '/panel/item/drop-property',
                                    'id' => $rel->id,
                                ]),
                                'data-msg' => Yii::t('app', 'Property value has been dropped'),
                            ]
                        );
                    },
                    'format' => 'raw',
                ]
            ]
        ]); ?>
    </div>
    <?php endif; ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>

<?php $modal = \app\modules\panel\widgets\ModalWidget::begin([
    'title' => Yii::t('app', 'Add item property'),
    'id' => 'add-property-modal',
    'class' => 'modal-lg',
    'backdrop' => false,
]); ?>

<?php $modal->addButton(new \app\modules\panel\widgets\ModalButtonWidget([
    'title' => Yii::t('app', 'Close'),
    'options' => [
        'class' => 'btn btn-default',
        'data-dismiss' => 'modal',
    ]
])) ?>

<?php $modal->addButton(new \app\modules\panel\widgets\ModalButtonWidget([
    'title' => Yii::t('app', 'Save'),
    'options' => [
        'class' => 'btn btn-primary',
        'id' => 'save-property-list',
    ]
])) ?>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="property-list"></div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="property-value-list"></div>
</div>

<?php \app\modules\panel\widgets\ModalWidget::end(); ?>

<script>
    $(function () {
        $(document).on('click', '#add-property', function () {
            $('#property-value-list').html('');
            $.loader.show();
            $.ajax({
                url: '<?= Yii::$app->urlManager->createUrl('/panel/property/list'); ?>',
                type: 'post',
                success: function (data) {
                    $('#property-list').html(data);
                    $('#add-property-modal').modal('show');
                },
                error: function (data) {
                    $.alert.error(data.responseText);
                },
                complete: function () {
                    $.loader.hide();
                }
            });
        });

        $(document).on('click', '.property-list li', function () {
            $('.property-list li').removeClass('active');
            $(this).toggleClass('active');
        });

        $(document).on('click', '.property-value-list li', function () {
            if ($(this).is('.active')) {
                $(this).removeClass('active');
                return false;
            }

            var isMultiple = parseInt($('.property-value-list').data('multiple')) === 1;
            if (!isMultiple && $('.property-value-list li.active').length >= 1) {
                $('.property-value-list li.active').removeClass('active');
            }

            $(this).toggleClass('active');
        });

        $(document).on('click', '#save-property-list', function () {
            $.loader.show();

            var values = [];
            $('.property-value-list li.active').each(function (index, $node) {
                values.push($($node).data('id'));
            });

            $.ajax({
                url: '/panel/item/save-property-list?id=<?= $model->id ?>',
                type: 'post',
                data: {
                    values: values
                },
                success: function () {
                    $('#add-property-modal').modal('hide');
                    $.pjax.reload({container: '#property-pjax'});
                },
                error: function (data) {
                    $.alert.error(data.responseText);
                },
                complete: function () {
                    $.loader.hide();
                }
            });
        });
    });
</script>
