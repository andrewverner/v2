<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Item[] $models
 * @var \yii\data\Pagination $pages
 */
?>

<div class="category-index">
    <div class="row">
        <?php if (!$models): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-info"><?= Yii::t('app', 'Sorry, the category is empty') ?></div>
            </div>
        <?php else: ?>
            <?php foreach ($models as $model): ?>
                <?= $this->render('_item', ['model' => $model]); ?>
            <?php endforeach; ?>

            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        <?php endif; ?>
    </div>
</div>
