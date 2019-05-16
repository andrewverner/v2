<?php

use app\modules\panel\widgets\BoxWidget;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Block;

/**
 * Created by PhpStorm.
 * User: Home
 * Date: 11.05.2019
 * Time: 20:36
 *
 * @var ActiveDataProvider $dataProvider
 * @var View $this
 */

$this->title = Yii::t('app', 'Blocks');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php $box = BoxWidget::begin(['title' => $this->title]); ?>

        <?php $box->addButton(Html::tag(
            'span',
            '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add new block'),
            [
                'class' => 'btn btn-primary btn-sm',
                'data-loader' => '',
                'data-get-form' => '',
                'data-url' => Yii::$app->urlManager->createUrl('/panel/block/form'),
                'data-pjax' => '#block-pjax',
                'data-type' => 'get',
                'data-msg' => Yii::t('app', 'Block has been saved'),
            ]
        )); ?>

        <?php Pjax::begin(['id' => 'block-pjax']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'code',
                [
                    'label' => Yii::t('app', 'Type'),
                    'value' => function ($model) {
                        /**
                         * @var Block $model
                         */
                        return Block::getTypesList($model->type);
                    },
                ],
                [
                    'label' => Yii::t('app', 'Position'),
                    'value' => function ($model) {
                        /**
                         * @var Block $model
                         */
                        return Block::getPositionsList($model->position);
                    },
                ],
                'active',
                'created',
            ],
        ]); ?>

        <?php Pjax::end(); ?>

        <?php BoxWidget::end(); ?>
    </div>
</div>
