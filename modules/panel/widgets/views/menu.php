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
<ul class="nav">
    <?php foreach ($items as $title => $url): ?>
    <li>
        <?= \yii\helpers\Html::a(Yii::t('app', $title), Yii::$app->urlManager->createUrl($url)); ?>
    </li>
    <?php endforeach; ?>
</ul>
