$(function() {

    var markers = [];

    var map = L.map('map-box', {
        center: [42.7339, 25.4858],
        minZoom: 2,
        zoom: 7
    });

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a', 'b', 'c']
    }).addTo(map);

    var markerClusters = L.markerClusterGroup({
        maxClusterRadius: 25
    });

    $.each(window.locations, function(idx, person) {
        var myIcon = L.icon({
            iconUrl: 'storage/' + person.icon,
            iconRetinaUrl: 'storage/' + person.icon,
            iconSize: [45, 45],
            iconAnchor: [9, 21],
            popupAnchor: [0, -14]
        });
        
        // Format person URL
        var person_url = window.routes['persons.view'];
        person_url = person_url.replace('{hash}', person.hash);

        var m = L.marker([person.lat, person.lng], {
                icon: myIcon
            })
            .bindPopup('<a href="' + person_url + '" target="_blank">' + person.name + '</a>');
        markerClusters.addLayer(m);
    });

    map.addLayer(markerClusters);
});