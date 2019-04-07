$(document).ready(function() {
    window.users = null;
    $.get('/site/users.html', function(result) {
        window.users = result;
        if (result instanceof Array) {
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
    }).on('mouseover', 'li.user div.user-item', function(e) {
        var target = $(e.target).closest('.user');
        var id = target.data('userId');
        var popup = $('div.popup-content[data-user-id="' + id +'"]');
        popup.addClass('active');
        popup.closest('.leaflet-popup').addClass('zindex2');
    }).on('mouseout', 'li.user div.user-item', function(e) {
        var target = $(e.target).closest('.user');
        var id = target.data('userId');
        var popup = $('div.popup-content[data-user-id="' + id +'"]');
        popup.removeClass('active');
        popup.closest('.leaflet-popup').removeClass('zindex2');
    }).on('click', 'label.filter-checkbox-label', function() {
        var results = [];
        $('input.filter-checkbox:checked').each(function() {
            var item = $(this);
            results = results.concat(window.users.filter(function(v) {
                return item.val() === v.data.type;
            }));
        });
        if (results.length === 0) {
            results = window.users;
        }
        $('ul#sidebar li:not(.filter-li)').remove();
        leaflet.clear();

        $("body").trigger({
            type: "leaflet.points.loaded",
            points: results
        });
    });
});