<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 11:18
 *
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Orders');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = \app\modules\panel\widgets\BoxWidget::begin([
            'title' => Yii::t('app', 'Orders'),
        ]) ?>

        <?php $box->addButton(\yii\helpers\Html::a(
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new order'),
            Yii::$app->urlManager->createUrl('/panel/order/create-order'),
            [
                'class' => 'btn btn-primary btn-sm',
            ]
        )); ?>

        <?php \yii\widgets\Pjax::begin(['id' => 'order-pjax']) ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
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
                [
                    'label' => Yii::t('app', 'User'),
                    'format' => 'html',
                    'value' => function ($model) {
                        /**
                         * @var \app\models\Order $model
                         */
                        $user = $model->user;

                        if (!$user) {
                            return Yii::t('app', 'Unregistered user');
                        }

                        return \yii\helpers\Html::a(
                            $user->getFullName(true),
                            Yii::$app->urlManager->createUrl([
                                '/panel/user/view',
                                'id' => $user->id,
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
            ]
        ]); ?>

        <?php \yii\widgets\Pjax::end() ?>

        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
