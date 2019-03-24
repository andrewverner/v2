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

        <?php /*$box->addButton(\yii\helpers\Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new order'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-get-form' => '',
                'data-loader' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/order/user-list'),
                'data-type' => 'post',
            ]
        )); */?>

        <?php \yii\widgets\Pjax::begin(['id' => 'order-pjax']) ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                [
                    'label' => Yii::t('app', 'User'),
                    'value' => function ($model) {
                        /**
                         * @var \app\models\Order $model
                         */

                        return $model->user->username;
                    }
                ]
            ]
        ]); ?>

        <?php \yii\widgets\Pjax::end() ?>

        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
