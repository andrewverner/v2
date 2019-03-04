<?php
/**
 * @var \yii\web\View $this
 * @var array $tabs
 */
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <?php $tabIndex = 1; ?>
        <?php foreach ($tabs as $tab): ?>
            <li class="<?= (isset($tab['active']) && $tab['active']) ? 'active' : ''; ?>">
                <a href="#tab_<?= $tabIndex ?>" data-toggle="tab" aria-expanded="true">
                    <?= $tab['title']; ?>
                </a>
            </li>
            <?php $tabIndex++; ?>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php $tabIndex = 1; ?>
        <?php foreach ($tabs as $tab): ?>
            <div class="tab-pane <?= (isset($tab['active']) && $tab['active']) ? 'active' : ''; ?>" id="tab_<?= $tabIndex ?>">
                <?= $tab['content']; ?>
            </div>
            <?php $tabIndex++; ?>
        <?php endforeach; ?>
    </div>
</div>
