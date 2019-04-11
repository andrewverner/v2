<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\DeliveryType $model
 */
?>
<div class="delivery-type-form">

    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/delivery-type/save'),
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'active')->checkbox(); ?>

    <?= $form->field($model, 'address_needed')->checkbox(); ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
    </div>

    <?php \yii\widgets\ActiveForm::end(); ?>

</div>
