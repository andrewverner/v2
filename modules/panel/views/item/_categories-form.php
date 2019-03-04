<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 04.03.2019
 * Time: 22:16
 *
 * @var \app\models\Item $model
 */
?>
<?= \kartik\select2\Select2::widget([
    'name' => 'category',
    'data' => \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name'),
    'value' => array_column($model->categoryRels, 'category_id'),
    'options' => [
        'multiple' => true,
        'placeholder' => Yii::t('app', 'Select category'),
        'id' => 'item-category',
        'class' => 'select2 form-control',
    ]
]); ?>
