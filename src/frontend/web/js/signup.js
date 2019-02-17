$(document).ready(function() {
    var typeaheadCallback = function(e, datum) {
        var id = null;
        if (datum.data) {
            loading.show();
            $.ajax({
                "method": "POST",
                "url" : "/geo-unit/register.html",
                "data": datum.data
            }).done(function(result) {
                id = result.id;
                loading.hide();
            }).fail(function() {
                loading.hide();
            });
            leaflet.clear();
            var coords = datum.data.Location.DisplayPosition;
            leaflet.addMarker([coords.Latitude, coords.Longitude], datum.data.Location.Address.Label);
        } else {
            id = datum.id;
        }
    };

    var locations = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/geo-unit/search-address.html?address=%QUERY',
            wildcard: '%QUERY'
        }
    });
    locations.initialize();
    $('#address').typeahead(null, {
        name: 'address',
        display: 'value',
        limit: 25,
        source: locations.ttAdapter(),
        templates: {
            notFound: '<p>Не бяха открити резултати</p>'
        }
    })
        .on("typeahead:select", typeaheadCallback)
        .on('typeahead:asyncrequest', function(e) {
            $('#address').addClass('input-loading');
        }).on('typeahead:render', function(e) {
            $('#address').removeClass('input-loading');
        });

    window.loading = {
        show: function () {
            $('#divLoading').removeClass('hidden').appendTo('#modalContainer .modal-content');
            $('#modalContainer .modal-content').addClass('tiny');
            $('#modalContainer').modal('show');
        },
        hide: function () {
            $('#modalContainer').modal('hide');
        }
    };
});