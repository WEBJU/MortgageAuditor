
(function() {
    'use strict';

    $('select[name="name"]').on('change', function() {
        $('select[name="name"] option').each(function() {
            var value = $('select[name="name"]').val();

            if ($(this).val() == value) {
                var email = $(this).attr('data-email');
                var ref = $(this).attr('data-ref');
                $('input[name="email"]').val(email);
                $('input[name="ref"]').val(ref);
            };
        });
    });
})();