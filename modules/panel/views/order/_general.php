<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Order $model
 */
?>
<?= \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'label' => Yii::t('app', 'User'),
            'format' => 'html',
            'value' => function ($model) {
                /**
                 * @var \app\models\Order $model
                 */
                return $model->user
                    ? \yii\helpers\Html::a(
                        $model->user->getFullName(),
                        Yii::$app->urlManager->createUrl([
                            '/panel/user/view',
                            'id' => $model->user_id,
                        ])
                    )
                    : Yii::t('app', 'Unregistered user');
            }
        ],
        'contact_name',
        'email:email',
        'phone',
        'delivery_type',
        [
            'label' => Yii::t('app', 'Delivery address'),
            'value' => function ($model) {
                /**
                 * @var \app\models\Order $model
                 */
                return $model->deliveryInfo->unrestricted_value ?? null;
            }
        ],
        'created'
    ]
]); ?>
