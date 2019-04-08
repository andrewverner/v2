<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */
?>

<?php \yii\widgets\Pjax::begin(['id' => 'user-pjax']); ?>

<?php if (Yii::$app->user->id != $model->id): ?>
<p class="pull-right">
    <?= \yii\helpers\Html::tag(
        'span',
        ($model->blocked ? '<i class="fas fa-lock-open"></i> ' : '<i class="fas fa-lock"></i> ')
        . Yii::t('app', $model->blocked ? 'Unblock' : 'Block'),
        [
            'data-id' => $model->id,
            'data-confirm' => Yii::t('app', '{action} user {username}?', [
                'username' => $model->username,
                'action' => $model->blocked ? 'Unblock' : 'Block',
            ]),
            'data-modal-type' => $model->blocked ? 'modal-success' : 'modal-warning',
            'data-type' => 'post',
            'data-title' => Yii::t('app', '{action} user?', [
                'action' => $model->blocked ? 'Unblock' : 'Block',
            ]),
            'data-pjax' => '#user-pjax',
            'data-msg' => Yii::t('app', 'User has been {action}', [
                'action' => $model->blocked ? 'unblocked' : 'blocked',
            ]),
            'data-url' => Yii::$app->urlManager->createUrl([
                '/panel/user/block',
                'id' => $model['id'],
            ]),
            'class' => implode(' ', array_filter([
                'btn', 'btn-sm',
                $model->blocked ? 'btn-success' : 'btn-warning',
            ])),
        ]
    ) ?>
</p>
<?php endif; ?>

<?= \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'last_name',
        'first_name',
        'middle_name',
        'email:email',
        'phone',
        'active',
        'blocked',
        'created',
    ],
]) ?>

<?php \yii\widgets\Pjax::end(); ?>
