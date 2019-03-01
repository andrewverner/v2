$(function () {
    function getValue(value, defaultValue) {
        return value ? value : defaultValue;
    }

    $(document).on('click', '[data-confirm]', function () {
        var $el = $(this),
            modalClass = getValue($el.data('class'), ''),
            $modal = $('<div></div>')
                .addClass('modal fade in ' + modalClass)
                .append(
                    $('<div></div>')
                        .addClass('modal-dialog')
                        .append(
                            $('<div></div>')
                                .addClass('modal-content')
                                .append(
                                    $('<div></div>')
                                        .addClass('modal-header')
                                        .append(
                                            $('<button></button>')
                                                .attr('type', 'button')
                                                .addClass('close')
                                                .attr('data-dismiss', 'modal')
                                                .attr('aria-label', 'Close')
                                                .append(
                                                    $('<span></span>')
                                                        .attr('aria-hidden', 'true')
                                                        .text('×')
                                                )
                                        )
                                        .append(
                                            $('<h4></h4>')
                                                .addClass('modal-title')
                                                .text(getValue($el.data('title'), ''))
                                        )
                                )
                        )
                        .append(
                            $('<div></div>')
                                .addClass('modal-body')
                                .append(
                                    $('<p></p>')
                                        .text($el.data('confirm'))
                                )
                        )
                        .append(
                            $('<div></div>')
                                .addClass('modal-footer')
                                .append(
                                    $('<button></button>')
                                        .addClass('btn btn-outline pull-left')
                                        .attr('type', 'button')
                                        .attr('data-dismiss', 'modal')
                                        .attr('id', 'cancel')
                                        .text('Close')
                                )
                                .append(
                                    $('<button></button>')
                                        .addClass('btn btn-outline')
                                        .attr('type', 'button')
                                        .attr('data-loader', '')
                                        .attr('id', 'confirm')
                                        .text('Yes')
                                )
                        )
                );

        $('body').append($modal);
        $modal.modal('show');

        $modal.on('hidden.bs.modal', function () {
            $(this).remove();
        });

        $(document).on('click', '#confirm', function () {
            $.ajax({
                url: $el.data('url'),
                type: $el.data('type'),
                success: function () {
                    $modal.modal('hide');
                    if ($el.data('message')) {
                        $.alert.success($el.data('message'));
                    }
                    if ($el.data('pjax')) {
                        $.pjax.reload({container: $el.data('pjax')});
                    }
                },
                error: function (data) {
                    $.alert.error(data.responseText);
                },
                complete: function () {
                    $.loader.hide();
                }
            });
        });
    });
});