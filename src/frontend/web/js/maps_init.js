$(document).ready(function() {
    $.get('/site/users.html', function(result) {
        if (result instanceof Array) {
            $("body").trigger({
                type: "leaflet.points.loaded",
                points: result
            });
        }
    });
});