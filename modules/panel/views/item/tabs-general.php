<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:19
 *
 * @var \app\models\Item $model
 */

use \yii\widgets\DetailView;
?>

<p class="pull-right">
    <?= \yii\helpers\Html::a(
        '<i class="fas fa-edit"></i> ' . Yii::t('app', 'Edit'),
        Yii::$app->urlManager->createUrl([
            '/panel/item/update',
            'id' => $model->id,
        ]),
        ['class' => 'btn btn-primary btn-sm']
    ); ?>
    <?= \yii\helpers\Html::tag(
        'span',
        '<i class="far fa-trash-alt"></i> ' . Yii::t('app', 'Delete'),
        [
            'class' => 'btn btn-danger btn-sm',
            'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'data-request-type' => 'non-ajax',
            'data-modal-type' => 'modal-danger',
            'data-url' => Yii::$app->urlManager->createUrl([
                '/panel/item/drop',
                'id' => $model->id,
            ])
        ]
    ); ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        'description:html',
        'price',
        'published',
        'created',
        'updated',
    ],
]) ?>
