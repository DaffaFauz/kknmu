/**
 * DataTables Basic
 */

'use strict';
document.addEventListener('DOMContentLoaded', function (e) {

  // Complex Header DataTable

  const dt_complex_header_table = document.querySelectorAll('.dt-complex-header');

  if (dt_complex_header_table.length > 0) {
    dt_complex_header_table.forEach(function (table) {
      new DataTable(table, {
        order: [[0, 'asc']],
        layout: {
          topStart: {
            rowClass: 'row mx-3 my-0 justify-content-between',
            features: [
              {
                pageLength: {
                  menu: [7, 10, 25, 50, 100],
                  text: 'Show_MENU_entries'
                }
              }
            ]
          },
          topEnd: {
            search: {
              placeholder: ''
            }
          },
          bottomStart: {
            rowClass: 'row mx-3 justify-content-between',
            features: ['info']
          },
          bottomEnd: 'paging'
        },
        displayLength: 7,
        language: {
          paginate: {
            next: '<i class="icon-base ti tabler-chevron-right scaleX-n1-rtl icon-18px"></i>',
            previous: '<i class="icon-base ti tabler-chevron-left scaleX-n1-rtl icon-18px"></i>',
            first: '<i class="icon-base ti tabler-chevrons-left scaleX-n1-rtl icon-18px"></i>',
            last: '<i class="icon-base ti tabler-chevrons-right scaleX-n1-rtl icon-18px"></i>'
          }
        }
      });
    });
  }

});
