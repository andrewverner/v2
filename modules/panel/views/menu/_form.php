<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="size-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/menu/save'),
        'method' => 'post',
    ]) ?>

    <?= $form->field($model, 'parent')->dropDownList(\yii\helpers\ArrayHelper::map(
        \app\models\Menu::find()->all(), 'id', 'title'
    )) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
