
(function() {
    'use strict';

    $('select[name="name"]').on('change', function() {
        $('select[name="name"] option').each(function() {
            var value = $('select[name="name"]').val();

            if ($(this).val() == value) {
                var reference = $(this).attr('data-reference');
                $('input[name="reference"]').val(reference);
            };
        });
    });

    $('select[name="employee"]').on('change', function() {
        $('select[name="employee"] option').each(function() {
            var value = $('select[name="employee"]').val();

            if ($(this).val() == value) {
                var reference = $(this).attr('data-reference');
                $('input[name="reference"]').val(reference);
            };
        });
    });
})();