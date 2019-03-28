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
    <div class="text-right">
        <?= \yii\helpers\Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add size'),
            [
                'data-get-form' => '',
                'data-loader' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/size/list-form'),
                'data-type' => 'post',
                'data-pjax' => '#size-pjax',
                'data-msg' => Yii::t('app', 'Data has been saved'),
                'class' => 'btn btn-primary btn-sm',
            ]
        ); ?>
        <!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sizeModal">
            <i class="fas fa-plus"></i> Add size
        </button>-->
    </div>
    <?php if (!$model->sizeRels): ?>
        <div class="alert alert-info margin-top">
            <?= Yii::t('app', 'Item has no sizes yet'); ?>
        </div>
    <?php else: ?>
    <div class="margin-top">
        <?php \yii\widgets\Pjax::begin(['id' => 'size-pjax']); ?>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $model->sizeRels,
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]),
            'columns' => [
                [
                    'label' => 'ID',
                    'value' => function ($rel) {
                        return $rel->size->id;
                    }
                ],
                [
                    'label' => 'Name',
                    'value' => function ($rel) {
                        return $rel->size->value;
                    }
                ],
                [
                    'label' => 'Published',
                    'value' => function ($rel) {
                        return $rel->published;
                    }
                ],
                [
                    'label' => '',
                    'value' => function ($rel) {
                        return \yii\helpers\Html::tag(
                            'span',
                            '<i class="fas fa-trash-alt pointer"></i>',
                            [
                                'data-confirm' => Yii::t('app', 'Drop size {size}?', [
                                    'size' => $rel->size->value,
                                ]),
                                'data-modal-type' => 'modal-danger',
                                'data-pjax' => '#size-pjax',
                                'data-type' => 'post',
                                'data-url' => Yii::$app->urlManager->createUrl([
                                    '/panel/item/drop-size',
                                    'id' => $rel->id,
                                ]),
                                'data-msg' => Yii::t('app', 'Size has been dropped'),
                                'data-title' => Yii::t('app', 'Drop size?'),
                            ]
                        );
                    },
                    'format' => 'raw',
                ]
            ]
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
    <?php endif; ?>
</div>

<!--<div class="modal fade" tabindex="-1" role="dialog" id="sizeModal" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?/*= Yii::t('app', 'Add size to item') */?></h4>
            </div>
            <div class="modal-body">
                <?/*= Select2::widget([
                    'name' => 'size',
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Size::find()->all(), 'id', 'value'),
                    'options' => [
                        'multiple' => true,
                        'placeholder' => Yii::t('app', 'Select size'),
                        'id' => 'item-size',
                    ]
                ]); */?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-size">Save changes</button>
            </div>
        </div>
    </div>
</div>-->
