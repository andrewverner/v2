<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;
use yii\helpers\Html;
use app\models\Item;

/**
 * @var ActiveDataProvider $dataProvider
 * @var View $this
 */
?>
<div class="ajax-pagination">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'price',
            'discount',
        ],
    ]); ?>
</div>
