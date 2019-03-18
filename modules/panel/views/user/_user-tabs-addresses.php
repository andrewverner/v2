<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\User $model
 */
?>

<p class="pull-right">
    <?= \yii\helpers\Html::tag(
        'span',
        '<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add address'),
        [
            'data-get-form' => '',
            'data-type' => 'get',
            'data-url' => Yii::$app->urlManager->createUrl([
                '/panel/user/address-form',
                'userId' => $model->id,
            ]),
            'data-loader' => '',
            'data-pjax' => '#address-pjax',
            'data-msg' => Yii::t('app', 'Address record has been saved'),
            'class' => 'btn btn-default btn-sm',
        ]
    ) ?>
</p>

<?php \yii\widgets\Pjax::begin(['id' => 'address-pjax']); ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $model->addressesDataProvider,
    'columns' => [
        'id',
        'unrestricted_value',
        'zip_code',
        'kladr_id',
        'fias_id',
        [
            'label' => '',
            'format' => 'raw',
            'value' => function ($address) {
                return \yii\helpers\Html::tag(
                    'span',
                    '<i class="fas fa-map-marked-alt"></i>',
                    [
                        'class' => 'see-on-map pointer',
                        'data-lat' => $address['geo_lat'],
                        'data-lng' => $address['geo_lng'],
                        'data-address' => $address['unrestricted_value'],
                    ]
                );
            }
        ]
    ],
]); ?>

<?php if ($model->addressesDataProvider->getModels()): ?>

    <?php \app\modules\panel\widgets\ModalWidget::begin([
        'id' => 'map-modal'
    ]); ?>

    <div id="map" style="width: 100%; height: 400px"></div>

    <?php \app\modules\panel\widgets\ModalWidget::end(); ?>

    <script>
        $(function () {
            ymaps.ready(init);
            var myMap;

            function init(){
                myMap = new ymaps.Map("map", {
                    center: [55.76, 37.64],
                    zoom: 15
                });

                $('.see-on-map').each(function (index, $node) {
                    myMap.geoObjects.add(new ymaps.Placemark([parseFloat($($node).data('lat')), parseFloat($($node).data('lng'))], {balloonContent: $($node).data('address')}));
                });
            }

            $(document).on('click', '.see-on-map', function () {
                myMap.setCenter([parseFloat($(this).data('lat')), parseFloat($(this).data('lng'))]);
                $('#map-modal').modal('show');
            });
        })
    </script>

<?php endif; ?>

<?php \yii\widgets\Pjax::end(); ?>
