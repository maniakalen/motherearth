$(document).ready(function() {
    var typeaheadCallback = function(e, datum) {
        var id = null, target = $(e.target);
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
            if (target.attr('id') === 'cityName' && $('#provinceName').val() === '') {
                var province = datum.data.Location.Address.County;
                $.ajax({
                    "method": "GET",
                    "url" : "/geo-unit/search-counties-list.html",
                    "data": {"unit":province}
                }).done(function(result) {
                    var data = result.shift();
                    typeaheadCallback({"target": "#provinceName"}, data);
                }).fail(function() {
                    loading.hide();
                });
            }
        } else {
            id = datum.id;
        }
    };

    var counties = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/geo-unit/search-counties-list.html?unit=%QUERY',
            wildcard: '%QUERY'
        }
    });
    counties.initialize();
    $('#provinceName').typeahead(null, {
        name: 'counties',
        display: 'value',
        source: counties.ttAdapter()
    }).on("typeahead:select", typeaheadCallback);


    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/geo-unit/search-cities-list.html?unit=%QUERY',
            wildcard: '%QUERY'
        }
    });
    cities.initialize();
    $('#cityName').typeahead(null, {
        name: 'cities',
        display: 'value',
        source: cities.ttAdapter()
    }).on("typeahead:select", typeaheadCallback);

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