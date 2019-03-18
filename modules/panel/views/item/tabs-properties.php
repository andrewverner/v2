<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:22
 *
 * @var \app\models\Item $model
 */

use kartik\select2\Select2;
?>
<div>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sizeModal">
            Add property
        </button>
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
                                'class' => 'drop-item-size',
                                'data-id' => $rel->id,
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

<div class="modal fade" tabindex="-1" role="dialog" id="sizeModal" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= Yii::t('app', 'Add size to item') ?></h4>
            </div>
            <div class="modal-body">
                <?= Select2::widget([
                    'name' => 'size',
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Size::find()->all(), 'id', 'value'),
                    'options' => [
                        'multiple' => true,
                        'placeholder' => Yii::t('app', 'Select size'),
                        'id' => 'item-size',
                    ]
                ]); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-size">Save changes</button>
            </div>
        </div>
    </div>
</div>
