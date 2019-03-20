<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/seo/save'),
        'method' => 'post',
    ]) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
        <?= $form->field($model, 'entity_id')->textInput() ?>
        <?= $form->field($model, 'entity_type')->textInput() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
