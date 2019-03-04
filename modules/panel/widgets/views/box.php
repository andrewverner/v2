<?php
/**
 * @var string $content
 * @var array $buttons
 * @var string $title
 */
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?= $title; ?></h3>
        <?php if ($buttons): ?>
            <div class="box-tools text-right">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-btn">
                        <?= implode('', $buttons); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="box-body table-responsive">
        <?= $content; ?>
    </div>
</div>
