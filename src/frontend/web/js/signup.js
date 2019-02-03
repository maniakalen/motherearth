$(document).ready(function() {
    var geounits = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/geo-unit/search-unit-data.html?unit=%QUERY',
            wildcard: '%QUERY'
        }
    });
    geounits.initialize();
    $('.typeahead-location').typeahead(null, {
        name: 'geo-units',
        display: 'value',
        source: geounits.ttAdapter()
    });
});