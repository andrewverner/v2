<?php
/* @var $this yii\web\View */
/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>
<h1>log/index</h1>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                [
                    'label' => Yii::t('app', 'Type'),
                    'value' => function ($data) {
                        return Yii::t('app', $data['event_type']);
                    }
                ],
                [
                    'label' => Yii::t('app', 'User'),
                    'value' => function ($data) {
                        return \app\models\User::findIdentity($data['user_id'])->username;
                    }
                ],
                [
                    'label' => Yii::t('app', 'Old attributes'),
                    'value' => function ($data) {
                        return $data['old_attributes']
                            ? \yii\helpers\Html::tag(
                                'pre',
                                print_r(json_decode($data['old_attributes'], true), true))
                            : '';
                    },
                    'format' => 'html',
                ],
                [
                    'label' => Yii::t('app', 'New attributes'),
                    'value' => function ($data) {
                        return $data['new_attributes']
                            ? \yii\helpers\Html::tag(
                                'pre',
                                print_r(json_decode($data['new_attributes'], true), true))
                            : '';
                    },
                    'format' => 'html',
                ],
                [
                    'label' => Yii::t('app', 'Timestamp'),
                    'value' => function ($data) {
                        return (new DateTime($data['datetime']))->format('d.m.Y H:i:s');
                    }
                ]
            ],
        ]) ?>
    </div>
</div>
