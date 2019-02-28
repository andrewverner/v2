<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 12:28
 *
 * @var array $items
 */
?>
<ul class="sidebar-menu tree" data-widget="tree">
    <li class="header">ADMIN MENU</li>
    <!-- Optionally, you can add icons to the links -->
    <?php foreach ($items as $title => $url): ?>
    <li>
        <?= \yii\helpers\Html::a(Yii::t('app', $title), Yii::$app->urlManager->createUrl($url)); ?>
    </li>
    <?php endforeach; ?>
</ul>
