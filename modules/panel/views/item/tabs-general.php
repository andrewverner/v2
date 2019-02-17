<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:19
 *
 * @var \app\models\Item $model
 */

use \yii\widgets\DetailView;
use yii\helpers\Html;
?>

<p>
    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        'description:html',
        'price',
        'published',
        'created',
        'updated',
    ],
]) ?>
