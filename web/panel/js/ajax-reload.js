$(function () {
    $.fn.ajaxReload = function (config) {
        var url = this.data('reload-url') || config.url,
            type = (this.data('reload-type') || config.type) || 'post',
            container = this;

        if (!url) {
            return false;
        }
        if (!type) {
            type = 'post';
        }

        $.ajax({
            url: url,
            type: type,
            data: config.data || false,
            success: function (data) {
                container.html(data);
            }
        });
    };
});
