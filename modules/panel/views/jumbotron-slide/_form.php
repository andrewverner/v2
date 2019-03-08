<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JumbotronSlide */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'text')->widget(\dosamigos\ckeditor\CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'full'
]) ?>

<?= $form->field($model, 'active')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
