<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\models\ItemProperty $model
 */
?>

<?php $box = \app\modules\panel\widgets\BoxWidget::begin([
    'title' => Yii::t('app', 'Property value list: {title}', ['title' => $model->title]),
]); ?>

<?php $box->addButton(\yii\helpers\Html::tag(
    'span',
    '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new value'),
    [
        'data-get-form' => '',
        'data-type' => 'post',
        'data-url' => Yii::$app->urlManager->createUrl([
            '/panel/property-value/form',
            'propertyId' => $model->id,
        ]),
        //'data-pjax' => '#property-pjax',
        'data-msg' => Yii::t('app', 'Property value has been saved'),
        'class' => 'btn btn-default btn-sm',
        'data-reload-source' => Yii::$app->urlManager->createUrl([
            '/panel/property-value/list',
            'propertyId' => $model->id,
        ]),
        'data-reload-target' => '#value-list-container',
        'data-reload-type' => 'get',
    ]
)); ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'value'
    ],
]); ?>

<?php \app\modules\panel\widgets\BoxWidget::end(); ?>
