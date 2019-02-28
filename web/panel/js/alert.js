$(function () {
    $.alert = {
        success: function (message) {
            this._show(message, 'alert-success');
        },

        info: function (message) {
            this._show(message, 'alert-info');
        },

        warning: function (message) {
            this._show(message, 'alert-warning');
        },

        error: function (message) {
            this._show(message, 'alert-danger');
        },

        _show: function (message, type) {
            $('.popup-alert').animate({
                top: '-200px'
            }, 350, function () {
                $(this).remove();
            });
            var $alert = $('<div></div>').addClass('popup-alert alert').addClass(type).html(message);
            $alert.css({
                position: 'fixed',
                width: '100%',
                maxWidth: '450px',
                top: '-100px',
                right: '25px',
                cursor: 'pointer',
                zIndex: 1100
            });
            $('body').append($alert);
            $alert.animate({
                top: '25px'
            }, 250);
            setTimeout(function () {
                $alert.fadeOut(250);
                setTimeout(function () {
                    $alert.remove();
                }, 300);
            }, 5000);
        }
    };

    $(document).on('click', '.popup-alert', function () {
        var $alert = $(this);
        $alert.fadeOut(250);
        setTimeout(function () {
            $alert.remove();
        }, 300);
    });
});
