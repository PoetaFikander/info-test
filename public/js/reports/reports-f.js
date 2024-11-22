// ##### global functions ##### -------------------------------------------------------------------

// ---- stałe
import {
    swalDefOptions,
    dataTableLang,
    dataTableInit,
    dataTableColumnDef, $overlaySpinner,
} from "../c.js"

// ---- funkcje
import {
    ax,
    getParametersFromForm,
    objLoop,
    selectOptionAdd,
    isNumber,
} from "../f.js";
import {UsersList} from "../users/users-f.js";

// ---- modale
// import {
// } from "../m.js";


class CustomersList {

    /**
     * @param data
     * .currentUserData - dane aktualnie zalogowanego users
     *
     */
    constructor(data) {
        console.group(`constructor: CustomersList`);

        const self = this;
        this.data = data;
        //console.log(this.data);
        this.$containerMain = $('div[data-name=container-main]');
        this.$sectionFilters = $('section[data-name=filters]', this.$containerMain);
        this.$btnSearch = $('button[name=btn-search]', this.$containerMain);

        this.$tableCustomersList = $('table[data-name=table-customers-list]', this.$containerMain);
        let tableCustomersListInit = {
            ...dataTableInit,
            rowId: 'cust_id',
            columns: [
                {data: 'cust_id'},                  // --- 0
                {data: 'cust_code'},                // --- 1
                {data: 'cust_name'},                // --- 2
                {data: 'cust_tin'},                 // --- 3
                {data: 'cust_zip_city'},            // --- 4
                {data: null},                       // --- 5 action
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    width: '5%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [1],
                    width: '8%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [2],
                    className: 'ellipsis',
                    width: '35%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [3],
                    width: '10%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [-1],
                    className: 'ellipsis',
                    orderable: false,
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            let a = '';
                            a += '&nbsp;' + '<a href="#" data-name="show" class="btn btn-warning btn-sm"><i data-name="show" class="bi bi-eye"></i>&nbsp;Koszty i zyski</a>';
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
        this.tableCustomersList = this.$tableCustomersList.DataTable(tableCustomersListInit);
        // -----------------
        this.$btnSearch.on('click', this.getCustomers);

        // -----------------
        console.groupEnd();
    }

    actions = (action, customerData, td) => {
        switch (action) {
            case 'show':
                location.href = '/reports/cust/cap-full/' + +customerData.cust_id;
                break;
            default:
                console.log(`UsersList.actions unknown action = ${action}`);
        }
    }


    getCustomers = () => {
        //console.log('getCustomers');
        const self = this;
        const params = getParametersFromForm(this.$sectionFilters);
        switch (params.filter_type) {
            case 'code' :
                params.code = params.filter_value;
                break;
            case 'name' :
                params.name = params.filter_value;
                break;
            case 'tin' :
                params.tin = params.filter_value;
                break;
        }
        //console.log(params);
        if (!(params.code === '' && params.name === '' && params.tin === '')) {
            ax(
                params,
                '/axcust/getcust',
                function (data) {
                    //console.log(data);
                    self.tableCustomersList.clear();
                    self.tableCustomersList.rows.add(data.customers).draw();
                }
            )
        }

    }

}


class CustomersCostsAndProfits {

    /**
     * @param data
     * .currentUserData - dane aktualnie zalogowanego users
     *
     */
    constructor(data) {
        console.group(`constructor: CustomersCostsAndProfits`);

        const self = this;
        this.data = data;
        //console.log(this.data);
        this.$containerMain = $('div[data-name=container-main]');
        this.$sectionFilters = $('section[data-name=filters]', this.$containerMain);




        // -----------------
        console.groupEnd();
    }
}

class MifCompany {

    /**
     * @param data
     * .currentUserData - dane aktualnie zalogowanego users
     *
     */
    constructor(data) {
        console.group(`constructor: MifCompany`);

        const self = this;
        this.data = data;
        console.log(this.data);
        this.$containerMain = $('div[data-name=container-main]');
        this.$formFilters = $('section[data-name=filters]', this.$containerMain);
        this.$selectPatrons = $('select[name=patron_altum_id]', this.$containerMain)
        this.$btnExport = $('a[data-name=btn-export]', this.$containerMain);

        this.$radioReportType = $('input[name=report_type]', this.$containerMain);
        this.$radioReportType.on('change', this.changeReportType);

        this.$btnSearch = $('button[name=btn-search]', this.$containerMain);
        this.$btnSearch.on('click', this.getBasicReport);

        // -------------------------------------------------------------------------------
        // ---- tableMifList
        this.$containerTableMifList = $('div[data-name=container-table-mif-list]', this.$containerMain);
        this.$tableMifList = $('table[data-name=table-mif-list]', this.$containerTableMifList);
        this.tableMifList = this.$tableMifList.DataTable();
        this.changeReportType();
        // -------------------------------------------------------------------------------
        this.getPatrons(this.refreshSelectPatrons);
        // ----------------------------------------------------------------------------

        // ----------------------------------------------------------------------------
        this.$btnGetExcel = $('button[name=get-excel]', this.$containerMain);
        this.$btnGetExcel.on('click', this.getBasicExcel);

        // -----------------
        console.groupEnd();
    }

    getBasicExcel = () => {
        const params = getParametersFromForm(this.$formFilters);
        $overlaySpinner.fadeIn(300);
        ax(
            params,
            '/axreportsmif/getbasicexcel',
            function (data) {
                // ---- hak na pobieranie pliku excel ajaxem
                let a = document.createElement("a");
                a.href = data.file;
                a.download = data.name;
                document.body.appendChild(a);
                a.click();
                a.remove();
                $overlaySpinner.fadeOut(300);
            }
        )
    }

    getBasicReport = () => {
        const self = this;
        const params = getParametersFromForm(this.$formFilters);
        $overlaySpinner.fadeIn(300);
        ax(
            params,
            '/axreportsmif/getbasicreport',
            function (data) {
                //console.log(data);
                if (+data.status === 0) {
                    self.tableMifList.clear();
                    self.tableMifList.rows.add(data.report).draw();
                } else {
                    console.log(`dupa z kota!`);
                    console.log(data);
                }
                $overlaySpinner.fadeOut(300);
            }
        )
    }

    getPatrons = (callback = null) => {
        const self = this;
        callback = (callback !== undefined && callback !== null) ? callback : false;
        const params = getParametersFromForm(this.$formFilters);
        $overlaySpinner.fadeIn(300);
        ax(
            params,
            '/axreportsmif/getpatrons',
            function (data) {
                if (callback) callback(data);
                $overlaySpinner.fadeOut(300);
            }
        )
    }

    refreshSelectPatrons = (data) => {
        this.$selectPatrons.html('');
        selectOptionAdd(this.$selectPatrons, 0, '---&nbsp;dowolny&nbsp;---');
        objLoop(data.patrons, (k, v, obj, params) => {
            selectOptionAdd(this.$selectPatrons, v.agr_patron_id, v.agr_patron_txt);
        }, {})
    }

    changeReportType = () => {
        const self = this;
        console.log('changeReportType');

        //this.setHref();
        this.tableMifList.clear();
        this.tableMifList.destroy();

        const tableMifListInit = {
            ...dataTableInit,
            rowId: 'dep_id',
            pageLength: 25,
        }

        const departmentReportInit = () => {

            const html = '' +
                '<tr>' +
                '<th scope="col">Oddział</th>' +
                '<th scope="col">Ilość umów</th>' +
                '<th scope="col">Ilość urządzeń</th>' +
                '<th scope="col">A3 kolor</th>' +
                '<th scope="col">A3 mono</th>' +
                '<th scope="col">A4 kolor</th>' +
                '<th scope="col">A4 mono</th>' +
                '</tr>'

            $('thead', self.$tableMifList).html('').append(html);

            tableMifListInit.columns = [
                {data: 'dep_acronym'},
                {data: 'agr_count'},
                {data: 'dev_count'},
                {data: 'a3_color'},
                {data: 'a3_mono'},
                {data: 'a4_color'},
                {data: 'a4_mono'},
            ];
        }

        const patronReportInit = () => {
            const html = '' +
                '<tr>' +
                '<th scope="col">Opiekun</th>' +
                '<th scope="col">Oddział</th>' +
                '<th scope="col">Ilość umów</th>' +
                '<th scope="col">Ilość urządzeń</th>' +
                '<th scope="col">A3 kolor</th>' +
                '<th scope="col">A3 mono</th>' +
                '<th scope="col">A4 kolor</th>' +
                '<th scope="col">A4 mono</th>' +
                '</tr>'

            $('thead', self.$tableMifList).html('').append(html);

            tableMifListInit.columns = [
                {data: 'patron_txt', className: 'ellipsis'},
                {data: 'dep_acronym'},
                {data: 'agr_count'},
                {data: 'dev_count'},
                {data: 'a3_color'},
                {data: 'a3_mono'},
                {data: 'a4_color'},
                {data: 'a4_mono'},
            ];
        }

        const agreementReportInit = () => {

            const html = '' +
                '<tr>' +
                '<th scope="col">Oddział</th>' +
                '<th scope="col">Opiekun</th>' +
                '<th scope="col">Umowa</th>' +
                '<th scope="col">Ilość umów</th>' +
                '<th scope="col">Ilość urządzeń</th>' +
                '<th scope="col">A3 kolor</th>' +
                '<th scope="col">A3 mono</th>' +
                '<th scope="col">A4 kolor</th>' +
                '<th scope="col">A4 mono</th>' +
                '</tr>'

            $('thead', self.$tableMifList).html('').append(html);

            tableMifListInit.columns = [
                {data: null},                   // --- 0
                {data: null},                   // --- 1
                {data: null},                   // --- 2
                {data: null},                   // --- 3
                {data: null},                   // --- 4
                {data: null},                   // --- 5
                {data: null},                   // --- 6
                {data: null},                   // --- 7
                {data: null},                   // --- 8
            ];
        }

        const deviceReportInit = () => {
            const html = '' +
                '<tr>' +
                '<th scope="col">Oddział</th>' +
                '<th scope="col">Opiekun</th>' +
                '<th scope="col">Umowa</th>' +
                '<th scope="col">Urządzenie</th>' +
                '<th scope="col">Ilość umów</th>' +
                '<th scope="col">Ilość urządzeń</th>' +
                '<th scope="col">A3 kolor</th>' +
                '<th scope="col">A4 kolor</th>' +
                '<th scope="col">A3 mono</th>' +
                '<th scope="col">A4 mono</th>' +
                '</tr>'

            $('thead', self.$tableMifList).html('').append(html);

            tableMifListInit.columns = [
                {data: null},                   // --- 0
                {data: null},                   // --- 1
                {data: null},                   // --- 2
                {data: null},                   // --- 3
                {data: null},                   // --- 4
                {data: null},                   // --- 5
                {data: null},                   // --- 6
                {data: null},                   // --- 7
                {data: null},                   // --- 8
                {data: null},                   // --- 9
            ];
        }

        const params = getParametersFromForm(this.$formFilters);
        switch (params.report_type) {
            case 'department':
                departmentReportInit();
                break;
            case 'patron':
                patronReportInit();
                break;
            case 'agreement':
                agreementReportInit();
                break;
            case 'device':
                deviceReportInit();
                break;
            default:
                console.log(`dupa z kota:  ${params.report_type}`)
        }

        this.tableMifList = this.$tableMifList.DataTable(tableMifListInit);

    }

    setHref = () => {
        const p = getParametersFromForm(this.$formFilters);
        this.$radioReportType.each(function (item) {
            const $node = $(this);
            if ($node.prop('checked')) {
                p.reportType = $node.val()
            }
        })
        console.log(this.$btnExport.attr('href'));
        const origin = window.location.origin;
        console.log(origin);
        this.$btnExport.attr('href', origin + '/reports/mif/basic-exp/' +
            p.year + '/' + p.month + '/' + p.department_id + '/' + p.patron_altum_id + '/' + p.reportType
        );
    }


}


// //// ---------------------------------------------------------------------------------------------
// //// ----------------------------------------------------------------------------------------------
export {
    CustomersList,
    CustomersCostsAndProfits,
    MifCompany,
}

