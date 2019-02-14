<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.2019
 * Time: 21:23
 *
 * @var string[] $items
 */
?>
<ul class="nav">
    <?php foreach ($items as $title => $url): ?>
        <li>
            <a href="<?= $url ?>"><?= $title ?></a>
        </li>
    <?php endforeach; ?>
</ul>
