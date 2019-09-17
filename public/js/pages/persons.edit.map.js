$(function() {

    // Checkbox switch event
    $(document).on('lcs-statuschange', '#exact-address', function() {
        if ($(this).is(':checked')) {
            $('#map-wrapper').fadeIn();
            map.invalidateSize();
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
    var endpoint = 'https://api.opencagedata.com/geocode/v1/json?q=';
    var marker;

    $('#button-search-address').on('click', function(e) {

        var encodedQuery = encodeURIComponent($('#map-address').val());
        var url = endpoint + encodedQuery + '&key=' + api_key;
        
        $.ajax({
            url: url,
            dataType: 'jsonp',
            success: function (data) {
                // Check your browser javascript console to look through the data
                if (data.total_results) {
                    $('#exact-address-text').val(data.results[0].formatted);
                    $('#exact-address-latitude').val(data.results[0].geometry.lat);
                    $('#exact-address-longitude').val(data.results[0].geometry.lng);
    
                    if (marker == null) {
                        marker = L.marker([data.results[0].geometry.lat, data.results[0].geometry.lng]).bindPopup(data.results[0].formatted).addTo(map).openPopup();
                    } else {
                        marker.setLatLng([data.results[0].geometry.lat, data.results[0].geometry.lng]).setPopupContent(data.results[0].formatted).openPopup();
                    }
                }
            }
        });
    });
});