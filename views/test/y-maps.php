<div id="map" style="width: 100%; height: 400px"></div>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap;

    function init(){
        myMap = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 7
        });

        myPlacemark = new ymaps.Placemark([55.76, 37.64], {hintContent: 'Moscow!', balloonContent: 'Capital of Russia'});

        myMap.geoObjects.add(myPlacemark);
    }
</script>
