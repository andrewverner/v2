<?php
/**
 * @var int $zoom
 * @var array $center
 * @var \app\modules\panel\widgets\YMapPlacemark[] $placemarks
 */
?>

<div id="map" style="width: 100%; height: 400px"></div>

<script>
    $(function () {
        ymaps.ready(init);
        var myMap;

        function init(){
            myMap = new ymaps.Map("map", {
                center: [<?= $center[0] ?>, <?= $center[1] ?>],
                zoom: <?= $zoom ?>
            });

            <?php if ($placemarks): ?>
                <?php foreach ($placemarks as $placemark): ?>
                    myMap.geoObjects.add(new ymaps.Placemark([<?= $placemark->lat ?>, <?= $placemark->lng ?>], {balloonContent: '<?= $placemark->title ?>'}));
                <?php endforeach; ?>
            <?php endif; ?>
        }
    })
</script>