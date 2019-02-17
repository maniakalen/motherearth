$(document).ready(function() {
    $('body').on('leaflet.map.loaded', function() {
        leaflet.map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;
            loading.show();
            $.get('/geo-unit/search-unit.html?lat=' + lat + '&lon=' + lon).done(function(data) {
                $('#address').val(data.Address.Label);
                $('#address-input').val(data.id);
                leaflet.clear();
                leaflet.addMarker([data.Coords.Latitude, data.Coords.Longitude], data.Address.Label);
                loading.hide();
            }).fail(function() {
                loading.hide();
            });
        });
    });
});