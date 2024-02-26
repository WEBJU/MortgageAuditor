
(function() {
    'use strict';

    $('.datatables-table').DataTable({
        responsive: true,
        pageLength: 15,
        lengthChange: false,
        searching: true,
        ordering: true
    });
})();