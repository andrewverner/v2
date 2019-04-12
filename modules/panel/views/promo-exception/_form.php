<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\PromoException $model
 */

use \yii\widgets\ActiveForm;
?>
<div class="promo-exception-form">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/promo-exception/save'),
        'method' => 'post',
    ]); ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->hiddenInput(); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
