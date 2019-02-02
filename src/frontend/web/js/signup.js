$(document).ready(function() {
    var geounits = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('display_name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/geo-unit/search-unit-data.html?unit=%QUERY',
            wildcard: '%QUERY'
        }
    });

    $('.typeahead-location').typeahead(null, {
        name: 'geo-units',
        display: 'display_name',
        source: geounits
    });
});