$(function() {

    // Checkbox switch event
    $(document).on('lcs-statuschange', '#exact-address', function() {
        if ($(this).is(':checked')) {
            $('#map-wrapper').fadeIn();
        } else {
            $('#map-wrapper').fadeOut();
        }
    });

    var map = L.map('map-box').setView([42.7339, 25.4858], 7);
    var options = {
        key: '97377b06ac014660977a7c06706ef1bf',
        limit: 10
    };

    L.tileLayer('https://{s}.tile.thunderforest.com/neighbourhood/{z}/{x}/{y}{r}.png?apikey=8943eaa983404a44ad6c6b7d5f35239e', {
        attribution: 'Data <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors, Map tiles &copy; <a href="https://www.thunderforest.com/">Thunderforest</a>',
        minZoom: 4,
        maxZoom: 18
    }).addTo(map);
    
    var api_key = '97377b06ac014660977a7c06706ef1bf';
    var endpoint = 'http://api.opencagedata.com/geocode/v1/json?q=';
    var encodedQuery = encodeURIComponent($('#map-address').val());

    $('#button-search-address').on('click', function(e) {
        var url = endpoint + encodedQuery + '&key=' + api_key;
        
        $.get(url, function(data) {
    		// Check your browser javascript console to look through the data
    		console.log(data);

    		//$('#address').text('Address: ' + data.results[0].formatted);
    		//$('#lat').text('Lattitude: ' + data.results[0].geometry.lat);
    		//$('#lng').text('Longitude: ' + data.results[0].geometry.lng);

    	});
        /*
        if (res) {
            if (marker) {
                marker.setLatLng(r.center).setPopupContent(r.name).openPopup();
            } else {
                marker = L.marker(r.center).bindPopup(r.name).addTo(map).openPopup();
            }
        }
        */
    });

});