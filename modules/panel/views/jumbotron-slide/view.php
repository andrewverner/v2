<?php

/* @var $this yii\web\View */
/* @var $model app\models\JumbotronSlide */
/* @var \app\modules\panel\models\UploadModel $uploadModel */

use app\modules\panel\assets\ItemAsset;
ItemAsset::register($this);

$this->title = $model->title;
\yii\web\YiiAsset::register($this);

$this->params['breadcrumbs'][$model->title] = Yii::$app->urlManager->createUrl([
    '/panel/item/view',
    'id' => $model->id,
])
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php \app\modules\panel\widgets\BoxWidget::begin([
            'title' => Yii::t('app', 'Jumbotron slide') . ': ' . $model->title,
            'buttons' => [
                \yii\helpers\Html::a(
                    '<i class="fas fa-edit"></i> ' . Yii::t('app', 'Edit'),
                    Yii::$app->urlManager->createUrl([
                        '/panel/jumbotron-slide/update',
                        'id' => $model->id,
                    ]),
                    ['class' => 'btn btn-primary btn-sm']
                ),
                \yii\helpers\Html::tag(
                    'span',
                    '<i class="far fa-trash-alt"></i> ' . Yii::t('app', 'Delete'),
                    [
                        'class' => 'btn btn-danger btn-sm',
                        'data-confirm' => Yii::t('app', 'Are you sure you want to delete this slide?'),
                        'data-request-type' => 'non-ajax',
                        'data-modal-type' => 'modal-danger',
                        'data-url' => Yii::$app->urlManager->createUrl([
                            '/panel/jumbotron-slide/drop',
                            'id' => $model->id,
                        ])
                    ]
                )
            ],
        ]); ?>

        <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'url',
                'title',
                'text:html',
                'active',
                'created',
                'updated',
            ],
        ]) ?>
        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?php $box = \app\modules\panel\widgets\BoxWidget::begin([
            'title' => Yii::t('app', 'Slide image')
        ]); ?>
        <?php $box->addButton(\yii\helpers\Html::tag(
            'span',
            'Upload image',
            ['class' => 'btn btn-default btn-sm']
        )); ?>
            <?php if (!$model->image): ?>
            <div class="alert alert-info">
                <?= Yii::t('app', 'This slide does not have an image yet'); ?>
            </div>
            <?php else: ?>
                <div class="col-lg-12 col-md-12 col-sm-4 col-xs-6">
                    <div class="img-thumbnail" style="background-image: url(<?= $model->image->getSource() ?>)"></div>
                </div>
            <?php endif; ?>
        <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
    </div>
</div>
