<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Promo $model
 */
?>
<div class="promo-form">
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/promo/save'),
        'method' => 'post'
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'expired_at')->textInput(['maxlength' => true, 'id' => 'datepicker']); ?>

    <?= $form->field($model, 'active')->checkbox(); ?>

    <?= $form->field($model, 'multiple')->checkbox(); ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->hiddenInput(); ?>
    </div>

    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

<script>
    $(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
