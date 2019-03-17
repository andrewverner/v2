<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\SignUpForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="size-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/user/create'),
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password1')->passwordInput() ?>

    <?= $form->field($model, 'password2')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>
