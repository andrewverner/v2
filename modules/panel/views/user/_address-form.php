<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\UserAddress $model
 * @var int $userId
 */
?>

<?php $form = \yii\widgets\ActiveForm::begin([
    'action' => Yii::$app->urlManager->createUrl('/panel/user/save-address'),
    'method' => 'post',
]) ?>

<?= \yii\helpers\Html::input('text', 'address', null, [
    'class' => 'datata-suggestions'
]) ?>

<div class="hidden">
    <?= $form->field($model, 'id')->hiddenInput() ?>
    <?= $form->field($model, 'user_id')->hiddenInput() ?>
    <?= $form->field($model, 'country')->hiddenInput() ?>
    <?= $form->field($model, 'region')->hiddenInput() ?>
    <?= $form->field($model, 'city')->hiddenInput() ?>
    <?= $form->field($model, 'street')->hiddenInput() ?>
    <?= $form->field($model, 'house')->hiddenInput() ?>
    <?= $form->field($model, 'flat')->hiddenInput() ?>
    <?= $form->field($model, 'zip_code')->hiddenInput() ?>
    <?= $form->field($model, 'geo_lat')->hiddenInput() ?>
    <?= $form->field($model, 'geo_lng')->hiddenInput() ?>
    <?= $form->field($model, 'kladr_id')->hiddenInput() ?>
    <?= $form->field($model, 'fias_id')->hiddenInput() ?>
    <?= $form->field($model, 'unrestricted_value')->hiddenInput() ?>
</div>

<?php \yii\widgets\ActiveForm::end(); ?>

<script>
    $('.datata-suggestions').suggestions({
        token: "9b2f26c2d6649cb24153b0ca71b3fb6a9604da44",
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            console.log(suggestion.value);
            console.log(suggestion);
        }
    });
</script>
