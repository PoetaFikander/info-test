"use strict";
console.log('module global constants start');

// ---- blokada ekranu podczas długich zapytań ajax
const $overlaySpinner = $('#overlay-spinner');

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
    pageLength : 10,
    autoWidth: true,
    searching: true,
    ordering: true,
    info: true,
    language: dataTableLang,
    rowId: 'id',
    order: [],
    columns: [],
    columnDefs: [],
    //createdRow: function (row, rowData, dataIndex) {}
}

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

}
