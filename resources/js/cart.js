(function ($) {
    $(document).ready(function () {
        $('.item-quantity').on('change', function (e) {
            $.ajax({
                url: "/cart/" + $(this).data('id'),
                method: 'put',
                data: {
                    quantity: $(this).val(),
                    _token: window.csrf_token  // Use the global variable
                }
            });
        });
    });
})(jQuery);