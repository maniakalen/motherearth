$(document).ready(function() {
    window.users = null;
    $.get('/site/users.html', function(result) {
        if (result instanceof Array) {
            window.users = result;
            $("body").trigger({
                type: "leaflet.points.loaded",
                points: result
            });
        }
    });

    $('body').on('click', '.popup-content', function() {
        if (!window.users) { return false; }
        $('#sidebar').toggleClass('displayed');
        var user = null;
        var userId = $(this).data('userId');
        $.map(window.users, function(i) {
            if (i.id === userId) {
                user = i;
                return true;
            }
        });

        if (user) {
            $('div#sidebar').html(Mustache.render($('script#users').html(), user.data));
        }
    });
});