<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:19
 *
 * @var \app\models\Page $model
 */

use \yii\widgets\DetailView;
?>

<p class="text-right">
    <span data-get-form data-loader data-type="get" data-pjax="#seo" class="btn btn-primary btn-sm" data-id="<?= $model->id ?>"
          data-url="<?= Yii::$app->urlManager->createUrl([
              '/panel/seo/form-by-entity',
              'type' => \app\models\Page::class,
          ]) ?>" data-msg="<?= Yii::t('app', 'Seo record has been saved') ?>">
        <i class="fas fa-edit"></i> <?= Yii::t('app', 'Edit'); ?>
    </span>
</p>

<?php \yii\widgets\Pjax::begin(['id' => 'seo']) ?>

<?php if (!$model->seo): ?>
    <div class="alert alert-info"><?= Yii::t('app', 'This page does not have any seo records'); ?></div>
<?php else: ?>

    <?= DetailView::widget([
        'model' => $model->seo,
        'attributes' => [
            'title',
            'keywords',
            'description',
            'active',
            'created',
            'updated',
        ],
    ]) ?>

<?php endif; ?>

<?php \yii\widgets\Pjax::end() ?>
