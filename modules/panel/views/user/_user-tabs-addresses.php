<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\User $model
 */
?>

<p class="pull-right">
    <?= \yii\helpers\Html::tag(
        'span',
        '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add address'),
        [
            'data-get-form' => '',
            'data-type' => 'get',
            'data-url' => Yii::$app->urlManager->createUrl([
                '/panel/user/address-form',
                'userId' => $model->id,
            ]),
            'data-loader' => '',
            'data-pjax' => '#address-pjax',
            'data-msg' => Yii::t('app', 'Address record has been saved'),
            'class' => 'btn btn-default btn-sm',
        ]
    ) ?>
</p>

<?php \yii\widgets\Pjax::begin(['id' => 'address-pjax']); ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider($model->addresses),
    'columns' => [
        'id',
        'unrestricted_value',
        'kladr_id',
        'fias_id',
    ],
]); ?>

<?php \yii\widgets\Pjax::end(); ?>
