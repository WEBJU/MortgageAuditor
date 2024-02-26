(function() {
    'use strict';

    $('select[name="type"]').on('change', function() {
        $('select[name="type"] option').each(function() {
            var value = $('select[name="type"]').val();

            if ($(this).val() == value) {
                var id = $(this).attr('data-id');
                $('input[name="typeid"]').val(id);
            };
        });
    });
})();