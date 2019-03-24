$(function () {
    $.notify = {
        reload: function () {
            $.ajax({
                url: '/panel/notification/widget',
                type: 'post',
                success: function (data) {
                    $('#notification-widget').html(data);
                }
            });
        }
    };
});