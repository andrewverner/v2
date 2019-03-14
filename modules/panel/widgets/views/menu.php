<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 12:28
 *
 * @var \app\modules\panel\widgets\MenuItem[] $items
 */
?>
<ul class="sidebar-menu tree" data-widget="tree">
    <li class="header">ADMIN MENU</li>
    <!-- Optionally, you can add icons to the links -->
    <?php foreach ($items as $item): ?>
    <li class="<?= $item->getClass() ?>">
        <a href="<?= Yii::$app->urlManager->createUrl($item->url ?? '#') ?>">
            <?= $item->getIcon() ?>
            <?= \yii\helpers\Html::tag('span', Yii::t('app', $item->label)) ?>
            <?= $item->hasChildren() ? \yii\helpers\Html::tag(
                'span',
                '<i class="fa fa-angle-left pull-right"></i>',
                ['class' => 'pull-right-container']
            ) : '' ?>
        </a>
        <?php if ($item->items): ?>
        <ul class="treeview-menu">
            <?php foreach ($item->items as $child): ?>
                <li class="<?= $child->getClass() ?>">
                    <?= \yii\helpers\Html::a(
                        $child->getIcon() . \yii\helpers\Html::tag('span', Yii::t('app', $child->label)),
                        Yii::$app->urlManager->createUrl($child->url ?? '#')
                    ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
