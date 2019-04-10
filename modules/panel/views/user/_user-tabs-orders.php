<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\User $model
 */
?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $model->orders,
        'pagination' => [
            'pageSize' => 25,
        ],
    ]),
    'columns' => [
        [
            'label' => 'ID',
            'format' => 'html',
            'value' => function ($model) {
                /**
                 * @var \app\models\Order $model
                 */
                return \yii\helpers\Html::a(
                    $model->id,
                    Yii::$app->urlManager->createUrl([
                        '/panel/order/view',
                        'id' => $model->id,
                    ])
                );
            }
        ],
        'price',
        [
            'label' => Yii::t('app', 'Status'),
            'format' => 'html',
            'value' => function ($model) {
                /**
                 * @var \app\models\Order $model
                 */
                return \yii\helpers\Html::tag('span', $model->status->title, [
                    'class' => 'order-status-bulge',
                    'style' => "background-color: {$model->status->color}",
                ]);
            }
        ],
        'created',
    ],
]); ?>
