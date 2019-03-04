$(function () {
    $('#add-category').on('click', function () {
        var categories = $('#item-category').val();
        if (categories.length == 0) {
            return false;
        }

        $.ajax({
            url: '/panel/item/add-category',
            type: 'post',
            data: {
                categories: categories,
                itemId: itemId
            },
            success: function () {
                $('#categoryModal').modal('hide');
                //$('#item-category').val(null).trigger('change');
                $.pjax.reload({container: '#category-pjax'});
            },
            error: function () {

            }
        });
    });

    $('#add-size').on('click', function () {
        var sizes = $('#item-size').val();
        if (sizes.length == 0) {
            return false;
        }

        $.ajax({
            url: '/panel/item/add-size',
            type: 'post',
            data: {
                sizes: sizes,
                itemId: itemId
            },
            success: function () {
                $('#sizeModal').modal('hide');
                $('#item-size').val(null).trigger('change');
                $.pjax.reload({container: '#size-pjax'});
            },
            error: function () {

            }
        });
    });

    $(document).on('click', '.drop-item-size', function () {
        $.ajax({
            url: '/panel/item/drop-size',
            type: 'post',
            data: {
                relId: $(this).data('id')
            },
            success: function () {
                $.pjax.reload({container: '#size-pjax'});
            },
            error: function () {

            }
        });
    });
});
