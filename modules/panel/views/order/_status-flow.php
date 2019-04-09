<?php
/**
 * @var \app\models\OrderStatus $model
 */
?>

<table width="100%" class="order-status-flow-table">
    <tr>
        <td width="20%">
            <?php if ($model->prevStatuses): ?>
                <ul class="order-status-flow">
                    <?php foreach ($model->prevStatuses as $status): ?>
                    <li data-id="<?= $status->status->id ?>" class="btn btn-sm" data-loader
                        style="background-color: <?= $status->status->color ?>; color: #fff;">
                        <?= $status->status->title ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <i class="fas fa-times-circle"></i>
            <?php endif; ?>
        </td>
        <td width="20%">
            <i class="fas fa-chevron-left"></i>
        </td>
        <td width="20%">
            <?= $model->title ?>
        </td>
        <td width="20%">
            <i class="fas fa-chevron-right"></i>
        </td>
        <td width="20%">
            <?php if ($model->nextStatuses): ?>
                <ul class="order-status-flow">
                    <?php foreach ($model->nextStatuses as $status): ?>
                        <li data-id="<?= $status->status->id ?>" class="btn btn-sm" data-loader
                            style="background-color: <?= $status->status->color ?>; color: #fff;">
                            <?= $status->status->title ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <i class="fas fa-times-circle"></i>
            <?php endif; ?>
        </td>
    </tr>
</table>
