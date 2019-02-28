$(function () {
    $.loader = {
        show: function () {
            $('#loader-container').css('visibility', 'visible').animate({
                opacity: 1
            }, 250);
        },

        hide: function () {
            $('#loader-container').stop().animate({
                opacity: 0
            }, 250, function () {
                $('#loader-container').css('visibility', 'hidden');
            });
        }
    };

    $(document).on('click', '[data-loader]', function () {
        $.loader.show();
    });
});
