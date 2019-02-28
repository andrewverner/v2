<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Log');
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('app', 'Log'); ?></h3>
                <!--<div class="box-tools text-right">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="input-group-btn">
                            <span class="btn btn-default btn-sm" data-toggle="modal" data-target="#saveDictionaryModal" data-clear="#dictionary-title" id="new-dictionary">
                                <i class="fas fa-plus"></i> Add new dictionary
                            </span>
                        </div>
                    </div>
                </div>-->
            </div>

            <div class="box-body table-responsive">
                <?php \yii\widgets\Pjax::begin(['id' => 'dictionaries-pjax']) ?>
                <?php if ($dataProvider->getModels()) : ?>
                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            [
                                'label' => Yii::t('app', 'Type'),
                                'value' => function ($data) {
                                    return Yii::t('app', $data['event_type']);
                                }
                            ],
                            [
                                'label' => Yii::t('app', 'User'),
                                'value' => function ($data) {
                                    return \app\models\User::findIdentity($data['user_id'])->username;
                                }
                            ],
                            [
                                'label' => Yii::t('app', 'Old attributes'),
                                'value' => function ($data) {
                                    return $data['old_attributes']
                                        ? \yii\helpers\Html::tag(
                                            'pre',
                                            print_r(json_decode($data['old_attributes'], true), true))
                                        : '';
                                },
                                'format' => 'html',
                            ],
                            [
                                'label' => Yii::t('app', 'New attributes'),
                                'value' => function ($data) {
                                    return $data['new_attributes']
                                        ? \yii\helpers\Html::tag(
                                            'pre',
                                            print_r(json_decode($data['new_attributes'], true), true))
                                        : '';
                                },
                                'format' => 'html',
                            ],
                            [
                                'label' => Yii::t('app', 'Timestamp'),
                                'value' => function ($data) {
                                    return (new DateTime($data['datetime']))->format('d.m.Y H:i:s');
                                }
                            ]
                        ],
                    ]) ?>
                <?php else: ?>
                    <div class="alert alert-info"><?= Yii::t('app', 'Log is empty') ?></div>
                <?php endif; ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>
