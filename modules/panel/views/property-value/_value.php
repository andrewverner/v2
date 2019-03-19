<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ItemProperty $property
 * @var \app\models\ItemPropertyValue[] $models
 */
?>
<ul class="property-value-list" data-multiple="<?= $property->multiple ?>">
    <?php foreach ($models as $model): ?>
    <li data-id="<?= $model->id ?>"><?= $model->value ?></li>
    <?php endforeach;; ?>
</ul>
