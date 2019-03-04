$(document).ready(function() {
    var typeaheadCallback = function(e, datum) {
        $('#add_product').data('product', datum);
        $('#add_product').show();
    };
    $('#add_product').click(function() {
        if ($(this).data('product')) {
            var product = $(this).data('product');
            $(this).data('product', null);
            addProductToList(product);
            $(this).hide();
        } else {

        }
    });

    window.addProductToList = function(product) {
        var box = $('<div class="alert alert-info alert-dismissible col-md-2"><span class="content"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
            '    <span aria-hidden="true">&times;</span>\n' +
            '  </button></div>');
        var clone = $('#user_product_ids').clone().removeAttr('id');
        clone.val(product.id);
        $('span.content', box).append(clone).append(product.value);
        $('#products_list_container').append(box);
    };
    var products = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/products/search.html?name=%QUERY',
            wildcard: '%QUERY'
        }
    });
    products.initialize();
    $('#products').typeahead(null, {
        name: 'products',
        display: 'value',
        limit: 25,
        source: products.ttAdapter(),
        templates: {
            notFound: '<p>Не бяха открити резултати</p>'
        }
    })
        .on("typeahead:select", typeaheadCallback)
        .on('typeahead:asyncrequest', function(e) {
            $('#products').addClass('input-loading');
        }).on('typeahead:render', function(e) {
            $('#products').removeClass('input-loading');
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