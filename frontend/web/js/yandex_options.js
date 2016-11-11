ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [48.023, 37.80224],
            zoom: 11
        }, {
            searchControlProvider: 'yandex#search'
        }),
        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Собственный значок метки',
            balloonContent: 'Это красивая метка'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: 'images/myIcon.gif',
            // Размеры метки.
            iconImageSize: [30, 42],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-3, -42]
        });

    myMap.geoObjects.add(myPlacemark);
    //Waryatav

     var result = ymaps.geoQuery(ymaps.geocode($('.company-location').html()));

    result.then(function () {
         myMap.geoObjects.add(result.get(0));
        var coord = result.get(0).geometry.getCoordinates();
        //console.log(coord);
        //myMap.setCenterPoint();
        myMap.panTo(coord ,{

            flying: true,

            duration: 2500

        });
    }, function () {
        //карта не достпна
    });
});
