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
    <p class="text-right">
        <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#categoryModal">
            <i class="fas fa-plus"></i> Add category
        </span>
    </p>
    <?php \yii\widgets\Pjax::begin(['id' => 'category-pjax']); ?>
        <?php if (!$model->categoryRels): ?>
            <div class="alert alert-info margin-top">
                <?= Yii::t('app', 'Item has no categories yet'); ?>
            </div>
        <?php else: ?>
            <div class="margin-top">
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => new \yii\data\ArrayDataProvider([
                        'allModels' => $model->categoryRels,
                        'pagination' => [
                            'pageSize' => 20,
                        ],
                    ]),
                    'columns' => [
                        [
                            'label' => 'ID',
                            'value' => function ($rel) {
                                return $rel->category->id;
                            }
                        ],
                        [
                            'label' => 'Name',
                            'value' => function ($rel) {
                                return $rel->category->name;
                            }
                        ],
                        [
                            'label' => 'Published',
                            'value' => function ($rel) {
                                return $rel->category->published;
                            }
                        ],
                        [
                            'label' => '',
                            'value' => function ($rel) {
                                return \yii\helpers\Html::tag(
                                    'span',
                                    '<i class="fas fa-trash-alt pointer"></i>',
                                    [
                                        'data-id' => $rel->id,
                                        'data-confirm' => Yii::t('app', 'Remove item from category {category}?', [
                                            'category' => $rel->category->name,
                                        ]),
                                        'data-title' => Yii::t('app', 'Remove category relation?'),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-pjax' => '#category-pjax',
                                        'data-msg' => Yii::t('app', 'Category relation has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/item/drop-category',
                                            'id' => $rel->id,
                                        ]),
                                    ]
                                );
                            },
                            'format' => 'raw',
                        ]
                    ]
                ]); ?>
            </div>
        <?php endif; ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="categoryModal" data-backdrop="false" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?= Yii::t('app', 'Add item to category') ?></h4>
                    </div>
                    <div class="modal-body">
                        <?= Select2::widget([
                            'name' => 'category',
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name'),
                            'value' => array_column($model->categoryRels, 'category_id'),
                            'options' => [
                                'multiple' => true,
                                'placeholder' => Yii::t('app', 'Select category'),
                                'id' => 'item-category',
                            ]
                        ]); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="add-category">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
