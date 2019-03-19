<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ItemProperty[] $models
 */
?>
<ul class="property-list">
    <?php foreach ($models as $model): ?>
    <li data-id="<?= $model->id ?>" data-ajax-load data-loader data-target="#property-value-list" data-url="<?= Yii::$app->urlManager->createUrl([
        '/panel/property-value/value',
        'propertyId' => $model->id,
    ]) ?>"><?= $model->title ?></li>
    <?php endforeach;; ?>
</ul>
