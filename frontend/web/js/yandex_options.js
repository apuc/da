var map = new Map();
var loc = $('.company-location').html();
var company_name = $('.company-title').html();
var company_loc = $('.company-location').html();

map.init({
    selector: '#map',
    center: loc,
    zoom: 11,
    placemarks: [
        {
            address: loc,
            options: [
                {key: 'draggable', value: false},
                {key: 'iconLayout', value: 'default#image'},
                {key: 'iconImageHref', value: '/theme/portal-donbassa/img/map-marker_.png'}
            ],
            properties: [
                {key: 'hintContent', value: company_name},
                {key: 'balloonContentHeader', value: "<h4>"+company_name+"</h4>"},
                {key: 'balloonContentBody', value: company_loc}
            ]
        },
    ]
});
//map.setIconContent('<img src="../theme/portal-donbassa/img/map-marker.png">');

// ymaps.ready(function () {
//     var myMap = new ymaps.Map('map', {
//             center: [48.023, 37.80224],
//             zoom: 11
//         }, {
//             searchControlProvider: 'yandex#search'
//         }),
//         myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
//             hintContent: 'Собственный значок метки',
//             balloonContent: 'Это красивая метка'
//         }, {
//             // Опции.
//             // Необходимо указать данный тип макета.
//             iconLayout: 'default#image',
//             // Своё изображение иконки метки.
//             iconImageHref: 'images/myIcon.gif',
//             // Размеры метки.
//             iconImageSize: [30, 42],
//             // Смещение левого верхнего угла иконки относительно
//             // её "ножки" (точки привязки).
//             iconImageOffset: [-3, -42]
//         });
//
//     myMap.geoObjects.add(myPlacemark);
//     //Waryatav
//
//      var result = ymaps.geoQuery(ymaps.geocode($('.company-location').html()));
//
//     result.then(function () {
//          myMap.geoObjects.add(result.get(0));
//         var coord = result.get(0).geometry.getCoordinates();
//         myMap.panTo(coord ,{
//
//             flying: true,
//
//             duration: 2500
//
//         });
//     }, function () {
//         //карта не достпна
//     });
// });



