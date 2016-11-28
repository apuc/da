var map = new Map();
var loc = $('.map-company-location').html();
var company_name = $('.map-company-title').html();
var company_loc = $('.map-company-location').html();

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




