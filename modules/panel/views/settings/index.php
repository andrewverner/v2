<?php
use app\modules\panel\widgets\BoxWidget;
use yii\web\View;
use app\components\settings\PanelSettings;
use app\components\settings\CommonSettings;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var CommonSettings $common
 */
?>

<?php $box = BoxWidget::begin(['title' => $common->getGroupTitle()]); ?>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => Yii::$app->urlManager->createUrl('/panel/settings/save')
    ]) ?>

    <?= $form->field($common, 'adminEmail')->textInput(); ?>

    <?php ActiveForm::end(); ?>

<?php BoxWidget::end(); ?>
