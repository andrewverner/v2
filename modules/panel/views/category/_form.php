<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\Category $model */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <?php $form = ActiveForm::begin([
        'id' => 'category-form',
    ]); ?>

    <label><?= Yii::t('app', 'Parent  category'); ?></label>
    <?= Html::dropDownList(
        'parent',
        $model->getParentNode()->id ?? null,
        \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name'),
        ['class' => 'form-control']
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->hiddenInput() ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
