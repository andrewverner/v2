$(function () {
    function getCategoryForm(categoryId) {
        $.ajax({
            url: '/panel/category/form',
            type: 'post',
            data: {
                id: categoryId
            },
            success: function (data) {
                $('#category-form-container').html(data);
                $('.select2').select2();
                $('#category-form-modal').modal('show');
            },
            error: function (data) {
                $.alert.error(data.responseText);
            },
            complete: function () {
                $.loader.hide();
            }
        });
    }

    $('#new-category').click(function () {
        getCategoryForm();
    });

    $(document).on('click', '#save-category-btn', function () {
        $.ajax({
            url: '/panel/category/save',
            type: 'post',
            data: $('#category-form').serializeArray(),
            success: function () {
                $('#category-form-modal').modal('hide');
                $.alert.success('Категория сохранена');
                $.pjax.reload({container: '#categories-pjax'});
            },
            error: function(data) {
                $.alert.error(data.responseText);
            },
            complete: function () {
                $.loader.hide();
            }
        });
    });

    $(document).on('click', '.edit-category', function () {
        getCategoryForm($(this).data('id'));
    });
});
