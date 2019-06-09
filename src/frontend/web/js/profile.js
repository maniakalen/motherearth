$(document).ready(function() {

    $('#products').typeahead().on('typeahead:render', function(e) {
        $('a#add-products').removeClass('hidden');
    });
    $('body').on('click', 'a#add-products', function() {
        $.post('/products/add.html', {'name':$('input#products').val()}, function(data) {
            var num = parseInt(data);
            if (!isNaN(num)) {
                $.post('/products/add-to-current-user.html', {"pid": num}, function(data) {
                    $('body').trigger('load.user.products');
                });
            }
        });
    }).on('load.user.products', function() {
        $('#products-list').load('/products/load-user-products.html');
    });

    $('body').trigger('load.user.products');
});