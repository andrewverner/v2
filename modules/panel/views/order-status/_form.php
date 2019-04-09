<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-status-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/order-status/save'),
        'method' => 'post',
    ]) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'color')->textInput(['id' => 'color-picker']) ?>

    <?= $form->field($model, 'is_final')->checkbox() ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(function () {
        $('#color-picker').spectrum({
            preferredFormat: "hex"
        });
    });
</script>
