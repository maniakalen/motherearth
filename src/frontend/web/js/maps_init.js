$(document).ready(function() {
    window.map = L.map('map').setView([42.5814857, 25.4725568], 8);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoibWFuaWFrYWxlbiIsImEiOiJjanI2ZjJnNWwwOHA2NDluamVrN3lhdG81In0.YASdNSL-lEnFojai4C96kw'
    }).addTo(window.map);
    var myIcon = L.divIcon({className: 'my-div-icon', html: '<img class="my-div-icon" src="./img/logo_small.jpg" width="26" height="26" />'});
    L.marker([42.699091, 23.322258], {icon: myIcon}).addTo(window.map);
});