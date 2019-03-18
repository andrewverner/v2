<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemPropertyValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-value-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/property-value/save'),
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
        <?= $form->field($model, 'property_id')->textInput() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
