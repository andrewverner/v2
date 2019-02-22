<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JumbotronSlide */

$this->title = Yii::t('app', 'Create Jumbotron Slide');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jumbotron Slides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumbotron-slide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
