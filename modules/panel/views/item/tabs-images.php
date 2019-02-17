<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 14:22
 *
 * @var \app\models\Item $model
 * @var \app\modules\panel\models\UploadModel $uploadModel
 */

use dosamigos\fileupload\FileUploadUI;
?>
<div>
    <?= FileUploadUI::widget([
        'model' => $uploadModel,
        'attribute' => 'files',
        'url' => ['/panel/item/add-image', 'id' => $model->id],
        'gallery' => true,
        'fieldOptions' => [
            'accept' => 'image/*'
        ],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
    ]); ?>
</div>
<div class="row">
    <?php \yii\widgets\Pjax::begin(['id' => 'images-pjax']) ?>
    <?php foreach ($model->imageRels as $rel): ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="img-thumbnail" style="background-image: url(<?= $rel->image->source ?>)"></div>
        </div>
    <?php endforeach; ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
