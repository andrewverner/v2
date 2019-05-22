<?php

use yii\grid\GridView;
use yii\web\View;
use app\modules\panel\widgets\BoxWidget;
use yii\data\ActiveDataProvider;
use app\modules\panel\models\ItemSearch;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var ItemSearch $searchModel
 */

$this->title = Yii::t('app', 'Create order');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = BoxWidget::begin(['title' => $this->title]); ?>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'title',
                'price',
                'discount',
            ],
        ]); ?>

        <?php Pjax::end(); ?>

        <?php BoxWidget::end(); ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = BoxWidget::begin(['title' => $this->title]); ?>

        <?php BoxWidget::end(); ?>
    </div>
</div>
