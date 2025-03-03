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

class EmployeeCreate {

    /**
     * @param data
     */
    constructor(data) {
        const self = this;
        console.group(`constructor: EmployeeCreate`);
        this.data = data;
        //console.log(this.data);

        this.$containerMain = $('div[data-name=container-main]');
        this.$selectAltumId = $('select[name=altum_id]', this.$containerMain);
        this.$formEmployee = $('form[name=form-employee]', this.$containerMain);

        this.$btnSelectAltumEmployee = $('button[name=btn-select-altum-employee]', this.$containerMain);
        this.$btnSelectAltumEmployee.on('click', this.selectAltumEmployee);


        // -------------------------------------------------------------------------------

        // -----------------
        console.groupEnd();
    }

    selectAltumEmployee = () => {
        const self = this;
        ax(
            {id: +this.$selectAltumId.val()},
            '/axemployees/getAltumEmployee',
            function (data) {
                console.log(data);
                if (+data.status === 0) {
                    //self.$formEmployee
                    $('input[name=altum_id]', self.$formEmployee).val(data.employee.id);
                    $('input[name=code]', self.$formEmployee).val(data.employee.code);
                    $('input[name=name]', self.$formEmployee).val(data.employee.name);
                    $('input[name=surname]', self.$formEmployee).val(data.employee.surname);
                    const email = data.employee.name.slice(0, 1).toLowerCase()
                        + '.'
                        + data.employee.surname.toLowerCase().escapeDiacritics()
                        + '@dks.pl';
                    $('input[name=email]', self.$formEmployee).val(email);

                } else {
                    console.log(`dupa z kota!`);
                    console.log(data);
                }
            }
        )

    }
}


class EmployeesList {

    /**
     * @param data
     * .employees - lista pracowników z Altum
     */
    constructor(data) {
        const self = this;
        console.group(`constructor: EmployeesList`);
        console.log(data);
        this.$containerMain = $('div[data-name=container-main]');
        // -------------------------------------------------------------------------------
        // ---- tableEmployeesList
        this.$tableEmployeesList = $('table[data-name=table-employees-list]', this.$containerMain);
        let tableEmployeesListInit = {
            ...dataTableInit,
            columns: [
                {data: 'id'},                   // --- 0
                {data: 'name_surname'},         // --- 1
                {data: 'department_id'},        // --- 2
                {data: 'section_id'},           // --- 3
                {data: 'workplace_id'},         // --- 4
                {data: null},                   // --- 5 action
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    width: '5%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [2],
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return rowData.department.name;
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [3],
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return rowData.section.name;
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [4],
                    className: 'ellipsis',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return rowData.workplace.name;
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [5],
                    orderable: false,
                    className: 'ellipsis',
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
        this.tableEmployeesList = this.$tableEmployeesList.DataTable(tableEmployeesListInit);
        this.tableEmployeesList.rows.add(data.employees).draw();
        // -------------------------------------------------------------------------------

        // -----------------
        console.groupEnd();
    }

    /**
     * Actions on the user
     * @param action - action name
     * @param employeeData - supported employee data
     * @param td - pointer to the cell generating the event
     */
    actions = (action, employeeData, td) => {
        //console.log(employeeData);
        switch (action) {
            case 'show':
                location.href = '/staff/employees/' + employeeData.id;
                break;
            case 'edit':
                location.href = '/staff/employees/' + employeeData.id + '/edit';
                break;
            case 'active':
                this.activateEmployee(employeeData, td);
                break;
            default:
                console.log(`EmoloyeesList.actions unknown action = ${action}`);
        }
    }

    /**
     * function to activate or deactivate employees
     * if the employee is active, he is deactivated and vice versa
     * @param employeeData - supported employee data
     * @param td - pointer to the cell generating the event
     */
    activateEmployee = (employeeData, td) => {
        const $a = $('a[data-name=active]', $(td));
        ax(
            employeeData,
            '/axemployees/activate',
            function (data) {
                if (+data.status === 0) {
                    if (+data.employee.is_active === 1) {
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
    EmployeeCreate,
    EmployeesList,
}


