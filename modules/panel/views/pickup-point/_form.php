<?php

use dosamigos\ckeditor\CKEditor;
use yii\web\View;
use app\models\PickupPoint;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var PickupPoint $model
 */
?>
<div class="pickup-point-form">
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => Yii::$app->urlManager->createUrl('/panel/pickup-point/save'),
    ]); ?>

    <?= $form->field($model, 'address')->textInput([
        'class' => 'dadata-suggestions',
        'id' => 'pickup-point-address',
    ]); ?>

    <?= $form->field($model, 'work_time')->widget(CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'basic'
    ]); ?>

    <?= $form->field($model, 'phone')->textInput(); ?>

    <?= $form->field($model, 'active')->checkbox(); ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->hiddenInput(); ?>
        <?= $form->field($model, 'geo_lat')->hiddenInput(['id' => 'geo-lat']); ?>
        <?= $form->field($model, 'geo_lng')->hiddenInput(['id' => 'geo-lng']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    $(function () {
        $('.dadata-suggestions').suggestions({
            token: "9b2f26c2d6649cb24153b0ca71b3fb6a9604da44",
            type: "ADDRESS",
            onSelect: function (suggestion) {
                $('#pickup-point-address').val(suggestion.unrestricted_value);
                $('#geo-lat').val(suggestion.data.geo_lat);
                $('#geo-lng').val(suggestion.data.geo_lon);
            }
        });
    });
</script>
