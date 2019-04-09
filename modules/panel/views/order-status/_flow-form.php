<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\OrderStatus $model
 * @var \app\models\OrderStatus[] $statuses
 * @var array $flow
 */
?>
<div id="order-status-flow-form">
<?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => Yii::t('app', 'Status flow')]); ?>
<?php $box->addButton(\yii\helpers\Html::tag(
    'span',
    '<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'),
    [
        'id' => 'save-order-flow',
        'class' => 'btn btn-primary btn-sm',
        'data-loader' => '',
        'data-id' => $model->id,
    ]
)); ?>
<table width="100%" class="order-status-flow-table">
    <tr>
        <td width="20%" style="text-align: left">
            <ul class="order-status-flow">
                <?php foreach ($statuses as $status): ?>
                    <?php $checked = $flow[2][$status->id] ?? null; ?>
                    <li>
                        <label>
                            <input type="checkbox" name="status<?= $status->id ?>" class="flow-checkbox" data-direction="2" data-id="<?= $status->id ?>" <?= $checked ? 'checked' : null ?> />
                            <span class="order-status-bulge" style="background-color: <?= $status->color; ?>; width: 100%"><?= $status->title ?></span>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </td>
        <td width="20%">
            <i class="fas fa-chevron-left"></i>
        </td>
        <td width="20%">
            <span class="order-status-bulge" style="background-color: <?= $model->color; ?>"><?= $model->title; ?></span>
        </td>
        <td width="20%">
            <i class="fas fa-chevron-right"></i>
        </td>
        <td width="20%" style="text-align: right">
            <ul class="order-status-flow">
                <?php foreach ($statuses as $status): ?>
                    <?php $checked = $flow[1][$status->id] ?? null; ?>
                    <li>
                        <label>
                            <span class="order-status-bulge" style="background-color: <?= $status->color; ?>; width: 100%"><?= $status->title ?></span>
                            <input type="checkbox" name="status<?= $status->id ?>" class="flow-checkbox" data-direction="1" data-id="<?= $status->id ?>" <?= $checked ? 'checked' : null ?> />
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </td>
    </tr>
</table>
<?php \app\modules\panel\widgets\BoxWidget::end(); ?>
</div>