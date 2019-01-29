$(document).ready(function() {
    window.map = L.map('map').setView([42.5814857, 25.4725568], 8);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw'
    }).addTo(window.map);
    var popup = L.popup({closeButton:false})
        .setLatLng([42.699091, 23.322258])
        .setContent('<img class="my-map-icon" src="./img/photo1.jpg" width="45" height="45" />')
        .openOn(map);
    var popup1 = L.popup({closeButton:false})
        .setLatLng([42.699091, 24.322258])
        .setContent('<img class="my-map-icon" src="./img/photo2.jpg" width="45" height="45" />');
    var popup2 = L.popup({closeButton:false})
        .setLatLng([42.699091, 25.322258])
        .setContent('<img class="my-map-icon" src="./img/photo3.jpg" width="45" height="45" />');

    map.addLayer(popup1).addLayer(popup2);
    // var popup = L.popup({closeButton:false})
    //     .setLatLng([42.799191, 23.622158])
    //     .setContent('<img class="my-map-icon" src="./img/logo_small.jpg" width="45" height="45" />')
    //     .openOn(map);
    //L.marker([42.699091, 23.322258], {icon: myIcon}).addTo(window.map);
});