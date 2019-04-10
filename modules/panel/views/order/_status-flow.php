<?php
/**
 * @var \app\models\Order $model
 */
?>

<table width="100%" class="order-status-flow-table">
    <tr>
        <td width="20%">
            <?php if ($model->status->prevStatuses): ?>
                <ul class="order-status-flow">
                    <?php foreach ($model->status->prevStatuses as $status): ?>
                    <li data-id="<?= $status->status->id ?>" class="btn btn-sm btn-default" data-loader
                        style="color: <?= $status->status->color ?>">
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
            <span class="order-status-bulge" style="background-color: <?= $model->status->color ?>"><?= $model->status->title ?></span>
            <p class="last-order-status-datetime"><?= $model->lastStatusLog->datetime ?? null ?></p>
        </td>
        <td width="20%">
            <i class="fas fa-chevron-right"></i>
        </td>
        <td width="20%">
            <?php if ($model->status->nextStatuses): ?>
                <ul class="order-status-flow">
                    <?php foreach ($model->status->nextStatuses as $status): ?>
                    <li data-id="<?= $status->status->id ?>" class="btn btn-sm btn-default" data-loader
                        style="color: <?= $status->status->color ?>">
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
