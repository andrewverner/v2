<?php
/**
 * @var \yii\web\View $this
 * @var \app\modules\panel\widgets\BoxDropDownButton $button
 */
?>
<div class="btn-group">
    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <?php if ($button->icon): ?>
        <i class="<?= $button->icon ?>"></i>
        <?php endif; ?>
        <?= $button->title ?>
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php foreach ($button->elements as $element): ?>
        <li>
            <?= \yii\helpers\Html::a($element['title'], 'javascript:void(0);', $element['options']) ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
