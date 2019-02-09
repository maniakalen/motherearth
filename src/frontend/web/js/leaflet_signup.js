$(document).ready(function() {
    $('body').on('leaflet.map.loaded', function() {
        leaflet.map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;
            loading.show();
            $.get('/geo-unit/search-unit.html?lat=' + lat + '&lon=' + lon).done(function(data) {
                $('#cityName').val(data.City.name);
                $('#provinceName').val(data.County.name);
                $('#address').val(data.Address.Label);
                loading.hide();
            }).fail(function() {
                loading.hide();
            });
        });
    });
});