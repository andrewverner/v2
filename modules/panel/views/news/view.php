<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][$model->title] = Yii::$app->urlManager->createUrl([
    '/panel/news/view',
    'id' => $model->id,
]);
\yii\web\YiiAsset::register($this);
?>
<div class="page-view">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $tabs = \app\modules\panel\widgets\TabsWidget::begin(); ?>
            <?php $tabs->addTab(
                Yii::t('app', 'General'),
                $this->render('_news-general', ['model' => $model])
            ); ?>
            <?php $tabs->addTab(
                Yii::t('app', 'SEO'),
                $this->render('_news-seo', ['model' => $model])
            ); ?>
            <?php \app\modules\panel\widgets\TabsWidget::end(); ?>
        </div>
    </div>
</div>
