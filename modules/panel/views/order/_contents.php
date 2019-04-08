<?php
/**
 * @var \app\models\Order $model
 */
?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $model->items,
    ]),
    'columns' => [
        [
            'label' => Yii::t('app', 'Image'),
            'format' => 'html',
            'value' => function ($item) {
                /**
                 * @var \app\models\OrderItem $item
                 */
                return \yii\helpers\Html::tag('div', null, [
                    'class' => 'item-thumbnail',
                    'style' => "background-image:url({$item->item->mainImage})",
                ]);
            }
        ],
        'id',
        [
            'label' => Yii::t('app', 'Item'),
            'format' => 'html',
            'value' => function ($item) {
                /**
                 * @var \app\models\OrderItem $item
                 */
                return \yii\helpers\Html::a($item->item->title, '#');
            }
        ],
        [
            'label' => Yii::t('app', 'Size'),
            'value' => function ($item) {
                /**
                 * @var \app\models\OrderItem $item
                 */
                return $item->size->value ?? null;
            }
        ],
        'quantity',
        [
            'label' => Yii::t('app', 'Price'),
            'value' => function ($item) {
                /**
                 * @var \app\models\OrderItem $item
                 */
                $totalPrice = $item->price * $item->quantity;
                return "{$item->price} * {$item->quantity} = {$totalPrice}";
            }
        ],
        [
            'label' => Yii::t('app', 'Status'),
            'value' => function ($item) {
                /**
                 * @var \app\models\OrderItem $item
                 */
                return $item->status->title;
            }
        ]
    ],
]); ?>