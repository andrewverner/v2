<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var \app\modules\panel\models\UserSearch $searchModel
 */

use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2Asset;

Select2Asset::register($this);

$this->title = Yii::t('app', 'Users');

?>
<div class="size-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $box = \app\modules\panel\widgets\BoxWidget::begin(['title' => Yii::t('app', 'Users')]);  ?>
            <?php $box->addButton(
                \yii\helpers\Html::tag(
                    'span',
                    '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add user'),
                    [
                        'class' => 'btn btn-default btn-sm',
                        'data-get-form' => '',
                        'data-type' => 'post',
                        'data-pjax' => '#user-pjax',
                        'data-url' => Yii::$app->urlManager->createUrl('/panel/user/form'),
                        'data-msg' => Yii::t('app', 'User has been saved'),
                    ]
                )
            ); ?>

            <?php Pjax::begin(['id' => 'items-pjax']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'label' => Yii::t('app', 'Username'),
                        'format' => 'html',
                        'value' => function ($model) {
                            return \yii\helpers\Html::a($model['username'], Yii::$app->urlManager->createUrl([
                                '/panel/user/view',
                                'id' => $model['id'],
                            ]));
                        }
                    ],
                    'email',
                    'active',
                    'blocked',
                    [
                        'label' => 'Full name',
                        'value' => function ($model) {
                            return implode(' ', array_filter([
                                $model['last_name'],
                                $model['first_name'],
                                $model['middle_name'],
                            ]));
                        }
                    ],
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return implode('', [
                                \yii\helpers\Html::a(
                                    '<i class="fas fa-edit"></i>',
                                    Yii::$app->urlManager->createUrl([
                                        '/panel/user/update',
                                        'id' => $model['id'],
                                    ]),
                                    ['class' => 'mf-grid-control-btn']
                                ),
                                /*\yii\helpers\Html::tag(
                                    'span',
                                    '<i class="far fa-trash-alt"></i>',
                                    [
                                        'class' => 'mf-grid-control-btn',
                                        'data-id' => $model['id'],
                                        'data-confirm' => Yii::t('app', 'Drop item {title}?', ['title' => $model['title']]),
                                        'data-modal-type' => 'modal-danger',
                                        'data-type' => 'post',
                                        'data-title' => Yii::t('app', 'Delete item?'),
                                        'data-pjax' => '#items-pjax',
                                        'data-msg' => Yii::t('app', 'Item has been dropped'),
                                        'data-url' => Yii::$app->urlManager->createUrl([
                                            '/panel/item/drop',
                                            'id' => $model['id']
                                        ]),
                                    ]
                                ),*/
                            ]);
                        }
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?>

            <?php \app\modules\panel\widgets\BoxWidget::end(); ?>
        </div>
    </div>
</div>
