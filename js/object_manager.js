ymaps.ready(function () {

    var map = new ymaps.Map('map', {
    center: [43.021249, 44.681988],
        zoom: 18,
        controls: ['zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl'],
    }, {
        searchControlProvider: 'yandex#search'
    }),
    objectManager = new ymaps.ObjectManager();

    // Загружаем GeoJSON файл с описанием объектов.
    $.getJSON('readdb.php')
        .done(function (geoJson) {
            // Добавляем описание объектов в формате JSON в менеджер объектов.
            objectManager.add(geoJson);
            // Добавляем объекты на карту.
            map.geoObjects.add(objectManager);
        });
});