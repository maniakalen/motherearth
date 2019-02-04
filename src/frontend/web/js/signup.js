$(document).ready(function() {
    var typeaheadCallback = function(obj, datum, name) {
        var id = null;
        if (datum.data) {
            $.ajax({
                "method": "POST",
                "url" : "/geo-unit/register.html",
                "data": datum.data
            }).done(function(result) {
                id = result.id;
            });
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
});