<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 24.03.2019
 * Time: 13:22
 *
 * @var \yii\web\View $this
 * @var \app\modules\panel\models\Notification[] $models
 */
?>
<!-- Menu toggle button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="far fa-bell"></i>
    <?php if ($models): ?>
        <span class="label label-warning"><?= count($models); ?></span>
    <?php endif; ?>
</a>
<ul class="dropdown-menu">
    <li class="header">You have <?= count($models); ?> unread notifications</li>
    <li>
        <!-- Inner Menu: contains the notifications -->
        <ul class="menu">
            <?php foreach (array_slice($models, 0, 10) as $model): ?>
            <li><!-- start notification -->
                <a href="#">
                    <div class="notify-datetime"><?= $model->datetime; ?></div>
                    <i class="<?= $model->getIconClass(); ?>"></i> <?= Yii::t('app', $model->text, $model->getParams()); ?>
                </a>
            </li>
            <?php endforeach; ?>
            <!-- end notification -->
        </ul>
    </li>
    <li class="footer"><a href="<?= Yii::$app->urlManager->createUrl('/panel/notification') ?>">View all</a></li>
</ul>
