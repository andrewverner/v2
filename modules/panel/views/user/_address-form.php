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
    'id' => 'user-address-form',
]) ?>

<?= \yii\helpers\Html::input('text', 'address', null, [
    'class' => 'datata-suggestions'
]) ?>

<div class="hidden">
    <?= $form->field($model, 'id')->hiddenInput() ?>
    <?= $form->field($model, 'user_id')->hiddenInput() ?>
    <?= $form->field($model, 'country')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'country',
    ]) ?>
    <?= $form->field($model, 'region')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'region',
    ]) ?>
    <?= $form->field($model, 'city')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'city',
    ]) ?>
    <?= $form->field($model, 'street')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'street',
    ]) ?>
    <?= $form->field($model, 'house')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'house',
    ]) ?>
    <?= $form->field($model, 'flat')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'flat',
    ]) ?>
    <?= $form->field($model, 'zip_code')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'postal_code',
    ]) ?>
    <?= $form->field($model, 'geo_lat')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'geo_lat',
    ]) ?>
    <?= $form->field($model, 'geo_lng')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'geo_lon',
    ]) ?>
    <?= $form->field($model, 'kladr_id')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'kladr_id',
    ]) ?>
    <?= $form->field($model, 'fias_id')->hiddenInput([
        'dadata-receiver' => '',
        'data-key' => 'fias_id',
    ]) ?>
    <?= $form->field($model, 'unrestricted_value')->hiddenInput(['id' => 'unrestricted_value']) ?>
</div>

<?php \yii\widgets\ActiveForm::end(); ?>

<script>
    $('.datata-suggestions').suggestions({
        token: "9b2f26c2d6649cb24153b0ca71b3fb6a9604da44",
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            $('input[dadata-receiver]').each(function (index, $node) {
                var key = $($node).data('key');
                if (suggestion.data.hasOwnProperty(key)) {
                    $($node).val(suggestion.data[key]);
                }
            });
            $('#unrestricted_value').val(suggestion.unrestricted_value);
        }
    });
</script>
