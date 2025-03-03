"use strict";
console.log('module global constants start');

// ---- blokada ekranu podczas długich zapytań ajax
const $overlaySpinner = $('#overlay-spinner');

const csrfToken = $('meta[name="csrf-token"]').attr('content');

// ---- domyślne parametry dla sweetalert2
const swalDefOptions = {
    title: '',
    text: '',
    footer: '',
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Tak',
    cancelButtonText: 'Nie',
    //width: '400px',
};

// ---- język polski dla DataTables
const dataTableLang = {
    "decimal": "",
    "emptyTable": "Brak danych w tabeli",
    "info": "Wyświetlono _START_ do _END_ z _TOTAL_ wierszy",
    "infoEmpty": "", //"Showing 0 to 0 of 0 entries"
    "infoFiltered": "odfiltrowanych ze wszystkich _MAX_ wierszy", //"(filtered from _MAX_ total entries)",
    "infoPostFix": "",
    "thousands": " ",
    "lengthMenu": "Wyświetl: _MENU_ wierszy",
    "loadingRecords": "Loading...",
    "processing": "",
    "search": "Wyszukaj:",
    "zeroRecords": "Nie znaleziono pasujących wierszy",
    "paginate": {
        "first": "Pierwszy",
        "last": "Ostatni",
        "next": "Następny",
        "previous": "Poprzedni"
    },
    "aria": {
        "sortAscending": ": activate to sort column ascending",
        "sortDescending": ": activate to sort column descending"
    }
};

const dataTableInit = {
    paging: true,
    pageLength: 10,
    autoWidth: true,
    searching: true,
    ordering: true,
    info: true,
    language: dataTableLang,
    rowId: 'DT_RowId',
    order: [],
    columns: [],
    columnDefs: [],
    //createdRow: function (row, rowData, dataIndex) {}
}


// dataTables column built in types
// num - Plain numbers (e.g. 1, 8432).
// num-fmt - Formatted numbers (e.g. $1'000, 8,000,000).
// html-num - Plain numbers with HTML (e.g. 10).
// html-num-fmt - Formatted numbers with HTML (e.g. _<em>€9.200,00</em>)
// date - Dates in ISO8601 format (e.g. 2151-04-01).
// html - HTML strings (e.g. <i>Tick</i>).
// string-utf8 - Plain text strings with UTF-8 characters (e.g. Creme Brulée). 2.1.0
// string - Plain text strings

const dataTableColumnDef = {
    targets: [],
    width: '',
    data: null,
    defaultContent: '',
    searchable: true,
    orderable: true,
    className: '',
    visible: true,
    type: 'string',
    //render: function (cellData, type, rowData) {},
    //createdCell: function (td, cellData, rowData, row, col) {},
}


export {
    $overlaySpinner,
    swalDefOptions,
    dataTableLang,
    dataTableInit,
    dataTableColumnDef,
    csrfToken,
}
