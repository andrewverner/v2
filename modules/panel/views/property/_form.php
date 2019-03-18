<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemProperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="size-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/property/save'),
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'multiple')->checkbox() ?>

    <?= $form->field($model, 'filterable')->checkbox() ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
