/**
 * DataTables Basic
 */

'use strict';

let fv, offCanvasEl;
document.addEventListener('DOMContentLoaded', function (e) {


    // Complex Header DataTable

    var dt_complex_header_table = $('.dt-complex-header');

    if (dt_complex_header_table.length) {
        console.log('DataTables init started');
        var dt_complex = dt_complex_header_table.DataTable({
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    orderable: false,
                    searchable: false,
                }
            ],
            order: [[2, 'desc']],
            dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9" f>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            lengthMenu: [7, 10, 25, 50, 100],
            language: {
                search: '',
                searchPlaceholder: 'Search...',
                lengthMenu: 'Show _MENU_ entries',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                paginate: {
                    next: '<i class="ti tabler-chevron-right"></i>',
                    previous: '<i class="ti tabler-chevron-left"></i>'
                }
            },
            displayLength: 7,
        });
        console.log('DataTables init finished');
    }
});
