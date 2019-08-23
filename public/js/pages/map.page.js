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
    
    var myIcon = L.icon({
        iconUrl: 'js/leafletjs/images/marker-icon.png',
        iconRetinaUrl: 'js/leafletjs/images/marker-icon-x2.png',
        iconSize: [25, 41],
        iconAnchor: [9, 21],
        popupAnchor: [0, -14]
    });
    
    var markerClusters = L.markerClusterGroup();
    
    $.each(window.locations, function(idx, person) {
        var m = L.marker([person.lat, person.lng], {
                icon: myIcon
            })
            .bindPopup('<a href="' + person.url + '" target="_blank">' + person.name + '</a>');
        markerClusters.addLayer(m);
    });
    
    map.addLayer(markerClusters);
});