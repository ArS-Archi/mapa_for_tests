ymaps.ready(function () {
    var map = new ymaps.Map('map', {
    center: [43.021249, 44.681988],
        zoom: 18,
        controls: ['zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl'],
    }, {
        searchControlProvider: 'yandex#search'
    });
    
});