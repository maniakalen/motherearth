$(document).ready(function() {
    $('body').on('leaflet.map.loaded', function() {
        console.debug('loaded');
        leaflet.map.on('click', function(e) {
            console.debug(e);
        });
    });
});