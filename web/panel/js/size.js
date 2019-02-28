$(function () {
    function getModelForm(id) {
        $.ajax({
            url: '/panel/size/form',
            type: 'post',
            data: {
                id: id
            },
            success: function (data) {
                $('#model-form-container').html(data);
                $('#form-modal').modal('show');
            },
            error: function (data) {
                $.alert.error(data.responseText);
            },
            complete: function () {
                $.loader.hide();
            }
        });
    }

    $('#new-model').click(function () {
        getModelForm();
    });

    $(document).on('click', '#save-model-btn', function () {
        $.ajax({
            url: '/panel/size/save',
            type: 'post',
            data: $('#model-form').serializeArray(),
            success: function () {
                $('#model-form-modal').modal('hide');
                $.alert.success('Размер сохранён');
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
        getModelForm($(this).data('id'));
    });
});
