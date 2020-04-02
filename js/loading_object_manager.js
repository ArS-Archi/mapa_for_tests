
ymaps.ready(function () {

    var map = new ymaps.Map('map', {
    center: [43.021249, 44.681988],
        zoom: 19,
        controls: ['zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl'],
    }, {
        searchControlProvider: 'yandex#search'
    });
    var loadingObjectManager = new ymaps.LoadingObjectManager('/readdb.php?bbox=%b', {   
                // Включаем кластеризацию.
                clusterize: false,
                // Зададим опции кластерам.
                // Опции кластеров задаются с префиксом cluster.
                clusterHasBalloon: false,
                // Опции объектов задаются с префиксом geoObject.
                geoObjectOpenBalloonOnClick: false
        });
    map.geoObjects.add(loadingObjectManager);

    map.events.add('drag', function () {
        var loadingObjectManager1 = new ymaps.LoadingObjectManager('/readdb.php?bbox=%b', {
            clusterize: false,
            clusterHasBalloon: false,
            geoObjectOpenBalloonOnClick: false
        });
        console.log("drag");
        
        map.geoObjects.add(loadingObjectManager1);
    });


});