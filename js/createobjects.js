ymaps.ready(init);

function init() {
// Получаем ширину и высоту рабочей области браузера
    var widthWindow = window.screen.availWidth;
    var heighWindow = window.screen.availHeight;
    console.log(widthWindow);
    console.log(heighWindow);
// --------------------------------------------------

    var myMap = new ymaps.Map('map', {
        center: [43.021249, 44.681988],
        zoom: 13
    }, {
        searchControlProvider: 'yandex#search'
    });

    var myPolyline = new ymaps.GeoObject({
        geometry: {
            type: "LineString",
            coordinates: [
                [43.0218,44.679278],
                [43.02201,44.679081]
            ]
        }
    });
/*
    // Добавим метку на карту.
    let url = 'http://localhost:9000/';
    let response = await fetch(url);
    let commits = await response.json(); // читаем ответ в формате JSON
    alert(commits[0].author.login);
  */  
    myMap.geoObjects.add(myPolyline);
   // myMap.geoObjects.add(myCircle);
}


