<?php

use app\models\Category;
use app\modules\panel\widgets\BoxWidget;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\web\View;
use yii\data\ArrayDataProvider;
use app\models\ItemCategory;

/**
 * Created by PhpStorm.
 * User: Home
 * Date: 11.05.2019
 * Time: 21:35
 *
 * @var Category $model
 * @var View $this
 * @var ArrayDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Category {name} items', ['name' => $model->name])
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = BoxWidget::begin(['title' => $this->title]); ?>

        <?php Pjax::begin(['id' => 'category-items-pjax']); ?>
        <?php if (!$dataProvider->getModels()): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-info">
                    <?= Yii::t('app', 'Category has no items yet'); ?>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($dataProvider->getModels() as $rel): ?>
                <?php
                /**
                 * @var ItemCategory $rel
                 */
                ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <div class="category-item"  style="background-image: url(<?= $rel->item->mainImage; ?>)">
                        <span class="drop-relation-btn" data-id="<?= $rel->id; ?>" data-pjax="#category-items-pjax"
                            data-confirm="<?= Yii::t('app', 'Remove item {item} from category {category}?', ['item' => $rel->item->title, 'category' => $model->name]) ?>"
                            data-type="post" data-modal-type="modal-warning" data-title="Drop relation?"
                            data-msg="<?= Yii::t('app', 'Item has been removed from category') ?>"
                            data-url="<?= Yii::$app->urlManager->createUrl([
                                '/panel/item-category/drop',
                                'id' => $rel->id,
                            ]); ?>">
                            <i class="fas fa-trash"></i>
                        </span>
                        <div class="category-item-data">
                            <?= $rel->item->title; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php Pjax::end(); ?>

        <?php BoxWidget::end(); ?>
    </div>
</div>
