<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Order $model
 */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'order-status-pjax']); ?>
<?= $this->render('_status-flow', ['model' => $model]) ?>
<?php \yii\widgets\Pjax::end(); ?>
<hr />
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
        [
            'label' => Yii::t('app', 'Pickup point'),
            'value' => function ($model) {
                /**
                 * @var \app\models\Order $model
                 */
                return $model->pickupPoint->address ?? null;
            }
        ],
        'created'
    ]
]); ?>
<?php if ($model->deliveryInfo || $model->pickupPoint): ?>
<?php $lat = $model->deliveryInfo->geo_lat ?? $model->pickupPoint->geo_lat; ?>
<?php $lng = $model->deliveryInfo->geo_lng ?? $model->pickupPoint->geo_lng; ?>
<?php $title = $model->deliveryInfo->unrestricted_value ?? $model->pickupPoint->address; ?>
<p>
    <?php $map = \app\modules\panel\widgets\YMapWidget::begin(); ?>
    <?php $map->addPlacemark(new \app\modules\panel\widgets\YMapPlacemark($lat, $lng, $title)); ?>
    <?php \app\modules\panel\widgets\YMapWidget::end(); ?>
</p>
<?php endif; ?>
