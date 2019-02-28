<?php
/**
 * @var \app\modules\panel\widgets\ModalWidget $widget
 * @var string $content
 */
?>
<div class="modal fade in <?= $widget->type ? "modal-{$widget->type}" : '' ?>"
     id="<?= $widget->id ?>"
     data-keyboard="<?= $widget->keyboard ? 'true' : 'false' ?>"
     data-backdrop="<?= $widget->keyboard ? 'true' : 'false' ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php if ($widget->title): ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><?= $widget->title ?></h4>
            </div>
            <?php endif; ?>
            <div class="modal-body">
                <p>
                    <?= $content ?>
                </p>
            </div>
            <?php if ($widget->buttons): ?>
                <div class="modal-footer">
                <?php foreach ($widget->buttons as $button): ?>
                    <?= $button ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
