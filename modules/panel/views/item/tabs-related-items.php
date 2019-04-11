<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Item $model
 */
?>
<div>
    <div class="text-right">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#relatedItemsModal">
            <i class="fas fa-plus"></i> Add related item
        </button>
    </div>
    <?php if (!$model->itemRels): ?>
        <div class="alert alert-info margin-top">
            <?= Yii::t('app', 'Item has no related items yet'); ?>
        </div>
    <?php else: ?>
        <div class="margin-top">
            <?php \yii\widgets\Pjax::begin(['id' => 'related-items-pjax']); ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $model->itemRels,
                    'pagination' => [
                        'pageSize' => 25,
                    ],
                ]),
                'columns' => [
                    [
                        'label' => 'Image',
                        'format' => 'html',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemItemRel $rel
                             */
                            return \yii\helpers\Html::tag(
                                'div',
                                null,
                                [
                                    'class' => 'item-thumbnail',
                                    'style' => "background-image: url({$rel->relatedItem->mainImage})"
                                ]
                            );
                        }
                    ],
                    [
                        'label' => 'ID',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemItemRel $rel
                             */
                            return $rel->relatedItem->id;
                        }
                    ],
                    [
                        'label' => 'Name',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemItemRel $rel
                             */
                            return $rel->relatedItem->title;
                        }
                    ],
                    [
                        'label' => 'Published',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemItemRel $rel
                             */
                            return $rel->relatedItem->published;
                        }
                    ],
                    [
                        'label' => 'Reserve',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\ItemItemRel $rel
                             */
                            return $rel->relatedItem->getReservesAmount();
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
