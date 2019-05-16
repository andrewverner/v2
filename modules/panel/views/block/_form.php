<?php

use yii\web\View;
use yii\helpers\Html;
use app\models\Block;
use yii\widgets\ActiveForm;

/**
 * Created by PhpStorm.
 * User: Home
 * Date: 11.05.2019
 * Time: 20:49
 *
 * @var View $this
 * @var Block $model
 */
?>

<div class="block-form">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl('/panel/block/save'),
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'code')->textInput(); ?>

    <?= $form->field($model, 'type')->dropDownList(Block::getTypesList()); ?>

    <?= $form->field($model, 'position')->dropDownList(Block::getPositionsList()); ?>

    <?= $form->field($model, 'active')->checkbox(); ?>

    <div class="hidden">
        <?= $form->field($model, 'id')->hiddenInput(); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
