// ##### global functions ##### -------------------------------------------------------------------

// ---- stałe
import {
    swalDefOptions,
    dataTableLang,
    dataTableInit,
    dataTableColumnDef,
} from "../c.js"

// ---- funkcje
import {
    ax,
} from "../f.js";

// ---- modale
// import {
// } from "../m.js";


class UsersList {

    /**
     * @param data
     * .users - lista userów systemu
     */
    constructor(data) {
        console.log(data);
        const self = this;
        console.group(`constructor: UsersList`);
        this.$containerMain = $('div[data-name=container-main]');

        // -------------------------------------------------------------------------------
        // ---- tableUsersList
        this.$tableUsersList = $('table[data-name=table-users-list]', this.$containerMain);
        let tableUsersListInit = {
            ...dataTableInit,
            autoWidth: false,
            columns: [
                {data: 'id'},                   // --- 0
                {data: 'name_surname'},         // --- 1
                {data: 'email'},                // --- 2
                {data: 'last_login_at'},        // --- 3
                {data: 'last_activity'},        // --- 4
                {data: null},                   // --- 5 roles
                {data: null},                   // --- 6 action
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    width: '5%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [1, 2, 3, 4],
                    className: 'ellipsis',
                },
                {
                    ...dataTableColumnDef,
                    targets: [5],
                    orderable: false,
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            let html = ''
                            rowData.roles.forEach((element) => {
                                html += '&nbsp;<span class="badge bg-primary">' + element.name + '</span>'
                            });
                            return html;
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [6],
                    orderable: false,
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            let buttonClass = 'btn-success';
                            let buttonTxt = 'Aktywuj'
                            if (+rowData.is_active) {
                                buttonClass = 'btn-danger';
                                buttonTxt = 'Deaktywuj'
                            }
                            let a = '';
                            a += '&nbsp;' + '<a href="#" data-name="show" class="btn btn-warning btn-sm"><i data-name="show" class="bi bi-eye"></i>&nbsp;Pokaż</a>';
                            a += '&nbsp;' + '<a href="#" data-name="edit" class="btn btn-primary btn-sm"><i data-name="edit" class="bi bi-pencil-square"></i>&nbsp;Edytuj</a>';
                            a += '&nbsp;' + '<a href="#" data-name="active" class="btn ' + buttonClass + ' btn-sm"><i data-name="active" class="bi bi-activity"></i>&nbsp;' + buttonTxt + '</a>';
                            return a;
                        } else {
                            return cellData;
                        }
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).on('click', (e) => {
                                self.actions($(e.target).data('name'), rowData, td);
                            }
                        );
                    },
                },
            ],
        }
        this.tableUsersList = this.$tableUsersList.DataTable(tableUsersListInit);
        this.tableUsersList.rows.add(data.users).draw();
        // -------------------------------------------------------------------------------

        // -----------------
        console.groupEnd();
    }

    /**
     * Actions on the user
     * @param action - action name
     * @param userData - supported user data
     * @param td - pointer to the cell generating the event
     */
    actions = (action, userData, td) => {
        switch (action) {
            case 'show':
                location.href = '/users/' + userData.id;
                break;
            case 'edit':
                location.href = '/users/' + userData.id + '/edit';
                break;
            case 'active':
                this.activateUser(userData, td);
                break;
            default:
                console.log(`UsersList.actions unknown action = ${action}`);
        }
    }

    /**
     * function to activate or deactivate users
     * if the user is active, he is deactivated and vice versa
     * @param userData - supported user data
     * @param td - pointer to the cell generating the event
     */
    activateUser = (userData, td) => {
        const $a = $('a[data-name=active]', $(td));
        ax(
            userData,
            '/axusers/activate',
            function (data) {
                if (+data.status === 0) {
                    if (+data.user.is_active === 1) {
                        $a.html('<i data-name="active" class="bi bi-activity"></i>' + '&nbsp;Deaktywuj')
                        $a.removeClass('btn-success').addClass('btn-danger');
                    } else {
                        $a.html('<i data-name="active" class="bi bi-activity"></i>' + '&nbsp;Aktywuj')
                        $a.removeClass('btn-danger').addClass('btn-success');
                    }
                } else {
                    console.log(`dupa z kota!`);
                    console.log(data);
                }
            }
        )
    }


}


// //// ---------------------------------------------------------------------------------------------
// //// ----------------------------------------------------------------------------------------------
export {
    UsersList,
}

// this.tableUsersList = this.$tableUsersList.DataTable({
//     paging: true,
//     autoWidth: true,
//     searching: true,
//     ordering: true,
//     info: true,
//     language: dataTableLang,
//     rowId: 'id',
//     order: [[1, 'asc'], [0, 'asc']],
//     columns: [
//         {data: 'id'},                   // --- 0
//         {data: 'name_surname'},         // --- 1
//         {data: 'email'},                // --- 2
//         {data: null},                   // --- 3 roles
//         {data: null},                   // --- 4 action
//
//     ],
//     'createdRow': function (row, rowData, dataIndex) {},
//     columnDefs: [
//         {
//             targets: [3],
//             //width: '4%',
//             data: null,
//             defaultContent: '',
//             //searchable: false,
//             orderable: false,
//             //className: 'text-center',
//             render: function (cellData, type, rowData) {
//                 if (type === 'display') {
//                     let roles = '';
//                     rowData.roles.forEach((element) => roles += ' ' + element.name);
//                     return roles;
//                 } else {
//                     return cellData;
//                 }
//             },
//             createdCell: function (td, cellData, rowData, row, col) {},
//         },
//         {
//             targets: [4],
//             //width: '4%',
//             data: null,
//             defaultContent: '',
//             //searchable: false,
//             orderable: false,
//             //className: 'text-center',
//             render: function (cellData, type, rowData) {
//                 if (type === 'display') {
//                     let a = '';
//                     a += '&nbsp;' + '<a href="#" data-name="show" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>&nbsp;Pokaż</a>';
//                     a += '&nbsp;' + '<a href="#" data-name="edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>&nbsp;Edytuj</a>';
//                     a += '&nbsp;' + '<a href="#" data-name="delete" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>&nbsp;Usuń</a>';
//                     return a;
//                 } else {
//                     return cellData;
//                 }
//             },
//             createdCell: function (td, cellData, rowData, row, col) {
//                 $(td).on('click', (e) => {
//                         self.actions.apply(self, [$(e.target).data('name'), rowData]);
//                     }
//                 );
//             },
//         },
//     ],
// });
