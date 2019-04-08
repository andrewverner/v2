<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'User: {username}', ['username' => $model->getFullName(true)]);
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $tabs = \app\modules\panel\widgets\TabsWidget::begin(); ?>
            <?php $tabs->addTab(
                Yii::t('app', 'General'),
                $this->render('_user-tabs-general', ['model' => $model])
            ); ?>
            <?php $tabs->addTab(
                Yii::t('app', 'Addresses'),
                $this->render('_user-tabs-addresses', ['model' => $model])
            ); ?>
            <?php \app\modules\panel\widgets\TabsWidget::end(); ?>
        </div>
    </div>
</div>
