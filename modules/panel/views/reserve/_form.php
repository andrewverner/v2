<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ItemReserve $model
 * @var yii\widgets\ActiveForm $form
 * @var \app\models\Store[] $stores
 */
?>

<div class="reserve-form">

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/reserve/save'),
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'store_id')->dropDownList($stores) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->textInput() ?>
        <?= $form->field($model, 'item_id')->textInput() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
