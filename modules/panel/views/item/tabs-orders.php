<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:22
 *
 * @var \app\models\Item $model
 */
?>
<div>
    <?php if (!$model->reserves): ?>
        <div class="alert alert-info margin-top">
            <?= Yii::t('app', 'There are no orders with this item'); ?>
        </div>
    <?php else: ?>
        <div class="margin-top">
            <?php \yii\widgets\Pjax::begin(['id' => 'orders-pjax']); ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $model->orderItems,
                    'pagination' => [
                        'pageSize' => 25,
                    ],
                ]),
                'columns' => [
                    [
                        'label' => Yii::t('app', 'Order'),
                        'format' => 'html',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\OrderItem $rel
                             */
                            return \yii\helpers\Html::a(
                                $rel->order_id,
                                Yii::$app->urlManager->createUrl([
                                    '/panel/order/view',
                                    'id' => $rel->order_id,
                                ])
                            );
                        }
                    ],
                    'quantity',
                    'price',
                    [
                        'label' => Yii::t('app', 'User'),
                        'format' => 'html',
                        'value' => function ($rel) {
                            /**
                             * @var \app\models\OrderItem $rel
                             */
                            return \yii\helpers\Html::a(
                                $rel->order->user->fullName,
                                Yii::$app->urlManager->createUrl([
                                    '/panel/user/view',
                                    'id' => $rel->order->user_id,
                                ])
                            );
                        }
                    ],
                    'created',
                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    <?php endif; ?>
</div>