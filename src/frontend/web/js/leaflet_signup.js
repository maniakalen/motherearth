$(document).ready(function() {
    $('body').on('leaflet.map.loaded', function() {
        console.debug('loaded');
        leaflet.map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;
            $.get('/geo-unit/search-unit.html?lat=' + lat + '&lon=' + lon);
        });
    });
});