$(document).ready(function() {
    window.users = null;
    $.get('/site/users.html', function(result) {
        if (result instanceof Array) {
            //window.users = result;
            $("body").trigger({
                type: "leaflet.points.loaded",
                points: result
            });
        }
    });

    $('body').on('click', '.popup-content', function() {
/*        if (!window.users) { return false; }
        //$('#sidebar').toggleClass('displayed');
        var user = null;
        var userId = $(this).data('userId');
        $.map(window.users, function(i) {
            if (i.id === userId) {
                user = i;
                return true;
            }
        });*/
    }).on('leaflet.points.loaded', function(e) {
        var tpl = $('script#users').html();
        $.map(e.points, function(item) {
            item.data['id'] = item.id;
            $('ul#sidebar').append(Mustache.render(tpl, item.data));
        });
    }).on('mouseover', 'li.list-group-item.user, li.list-group-item.user *', function(e) {
        var target = $(e.target);
        var id = target.data('userId');
        $('div.popup-content[data-user-id="' + id +'"]').addClass('active');
    }).on('mouseout', 'li.list-group-item.user', function(e) {
        var target = $(e.target);
        var id = target.data('userId');
        $('div.popup-content[data-user-id="' + id +'"]').removeClass('active');
    });
});