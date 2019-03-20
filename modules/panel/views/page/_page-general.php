<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Page $model
 */
?>

<p class="text-right">
    <?= \yii\helpers\Html::a(
        '<i class="fas fa-edit"></i> ' . Yii::t('app', 'Edit'),
        Yii::$app->urlManager->createUrl([
            '/panel/page/update',
            'id' => $model->id,
        ]),
        ['class' => 'btn btn-primary btn-sm']
    ); ?>
    <?= \yii\helpers\Html::tag(
        'span',
        '<i class="far fa-trash-alt"></i> ' . Yii::t('app', 'Delete'),
        [
            'class' => 'btn btn-danger btn-sm',
            'data-confirm' => Yii::t('app', 'Are you sure you want to delete this page?'),
            'data-title' => Yii::t('app', 'Delete page?'),
            'data-request-type' => 'non-ajax',
            'data-modal-type' => 'modal-danger',
            'data-url' => Yii::$app->urlManager->createUrl([
                '/panel/page/drop',
                'id' => $model->id,
            ])
        ]
    ); ?>
</p>

<?= \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        'text:html',
        'published',
        'created',
        'updated',
    ],
]); ?>
