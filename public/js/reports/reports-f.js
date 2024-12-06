// ##### global functions ##### -------------------------------------------------------------------

// ---- stałe
import {$overlaySpinner, dataTableColumnDef, dataTableInit, csrfToken,} from "../c.js"

// ---- funkcje
import {fx, ax, getParametersFromForm, objLoop, selectOptionAdd,} from "../f.js";
import {MyModal} from "../m.js";

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
        //console.log(data);
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
        if (!(params.code === '' && params.name === '' && params.tin === '')) {
            this.fetchCustomers(params);
        }

    }

    fetchCustomers = async (params) => {
        $overlaySpinner.fadeIn(300);
        const [customers,] = await Promise.all([fx('/axcust/getcust', params),]);
        this.refreshTableCustomers(customers.customers);
        $overlaySpinner.fadeOut(300);
    }

    refreshTableCustomers = (customers) => {
        this.tableCustomersList.clear();
        this.tableCustomersList.rows.add(customers).draw();
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
        this.$containerMain = $('div[data-name=container-main]');
        this.$sectionFilters = $('section[data-name=filters]', this.$containerMain);
        this.$btnSearch = $('button[name=btn-search]', this.$containerMain);
        // ------
        this.results = {
            'costs_wz_count': 0,
            'costs_wz_value': 0,
            'costs_correction_count': 0,
            'costs_correction_value': 0,
            'costs_summary': 0,
            'profit_fs_count': 0,
            'profit_fs_value': 0,
            'profit_correction_count': 0,
            'profit_correction_value': 0,
            'profit_summary': 0,
            'agr_fs_count': 0,
            'agr_fs_value': 0,
            'agr_correction_count': 0,
            'agr_correction_value': 0,
            'agr_summary': 0,
        }
        // ------
        this.$tableWzCostList = $('table[data-name=table-wz-cost-list]', this.$containerMain);
        let tableWzCostListInit = {
            ...dataTableInit,
            rowId: 'doc_id',
            'createdRow': function (row, data, dataIndex) {
                $(row).addClass('pointer');
            },
            columns: [
                {data: 'doc_no'},                  // --- 0
                {data: 'doc_date'},                // --- 1
                {data: 'doc_source_no'},           // --- 2
                {data: 'doc_net_value'},           // --- 3
                {data: 'doc_gross_value'},         // --- 4
                {data: 'doc_items_purchase_value'},      // --- 5
                {data: 'related_doc_no'},          // --- 6
                {data: 'doc_corrections_no_list'}, // --- 7
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [3, 4, 5],
                    type: 'num',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [6],
                    visible: false,
                },
            ],
        }
        this.tableWzCostList = this.$tableWzCostList.DataTable(tableWzCostListInit);
        // ------
        this.$tableFsProfitList = $('table[data-name=table-fs-profit-list]', this.$containerMain);
        let tableFsProfitListInit = {
            ...dataTableInit,
            rowId: 'doc_id',
            columns: [
                {data: 'doc_no'},                  // --- 0
                {data: 'doc_date'},                // --- 1
                {data: 'doc_source_no'},           // --- 2
                {data: 'doc_net_value'},           // --- 3
                {data: 'doc_gross_value'},         // --- 4
                {data: 'doc_items_purchase_value'},      // --- 5
                {data: 'related_doc_no'},          // --- 6
                {data: 'doc_corrections_no_list'}, // --- 7
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).addClass('pointer').attr('data-id', rowData.doc_id).attr('data-type', 'default')
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [3, 4, 5],
                    type: 'num',
                    //width: '5%',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [6],
                    createdCell: function (td, cellData, rowData, row, col) {
                        const id = parseInt(rowData.child_doc_id) > 0 ? rowData.child_doc_id : rowData.parent_doc_id;
                        $(td).addClass('pointer').attr('data-id', id).attr('data-type', 'default')
                    },
                },

            ],

        }
        this.tableFsProfitList = this.$tableFsProfitList.DataTable(tableFsProfitListInit);
        // ------
        this.$tableWzItemsList = $('table[data-name=table-wz-items-list]', this.$containerMain);
        let tableWzItemsListInit = {
            ...dataTableInit,
            rowId: 'art_id',
            autoWidth: false,
            order: [[3, 'desc'], [1, 'asc']],
            columns: [
                {data: 'art_code'},                      // --- 0
                {data: 'art_name'},                    // --- 1
                {data: 'art_catalogue_number'},         // --- 2
                {data: 'item_quantity'},               // --- 3
                {data: 'item_purchase_value'},                        // --- 4
                {data: null},      // --- 5
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    className: 'ellipsis',
                    width: '10%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [1],
                    className: 'ellipsis',
                    //width: '35%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [2],
                    className: 'ellipsis',
                    width: '10%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [3, 4],
                    type: 'num',
                    width: '11%',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [5],
                    type: 'num',
                    width: '13%',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            let res = parseFloat(rowData.item_purchase_value) / parseFloat(rowData.item_quantity);
                            return (res).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },
            ],

        }
        this.tableWzItemsList = this.$tableWzItemsList.DataTable(tableWzItemsListInit);
        // -----------------
        this.$btnSearch.on('click', this.getData);
        // ---------------------------------------------------------------------------------------
        // ----------------- TODO testy modala
        this.$tableActiveAgreements = $('table[data-name=active-agreements]', this.$containerMain)

        this.$tableActiveAgreements.on('click', 'tr', async (e) => {
            const id = parseInt($(e.currentTarget).data('id'));
            console.log(id);
            const modal = new MyModal('agreement', {'agr_id': id});
            await modal.initialize();
        })

        this.$tableWzCostList.on('click', 'tr', async (e) => {
            const id = parseInt($(e.currentTarget).attr('id'));
            const modal = new MyModal('altumDocument', {'doc_id': id});
            await modal.initialize();
        })

        this.$tableFsProfitList.on('click', 'tr', async (e) => {
            const id = parseInt($(e.target).attr('data-id'));
            let modal = null;
            switch ($(e.target).attr('data-type')) {
                case 'default':
                    modal = new MyModal('altumDocument', {'doc_id': id});
                    break;
                case 'agreement':
                    modal = new MyModal('agreement', {'agr_id': id});
                    break;
                default:
                    console.log('dupa z kota !')
            }
            if (modal !== null) {
                await modal.initialize();
            }
        })


        // ----------------- TODO testy modala end
        // ---------------------------------------------------------------------------------------
        // -----------------
        console.groupEnd();
    }

    getData = () => {
        const params = getParametersFromForm(this.$sectionFilters);
        this.fetchCostsAndProfits(params).finally(() => {
                //console.log('fetchCostsAndProfits END!')
            }
        );
    }

    fetchCostsAndProfits = async (params) => {
        $overlaySpinner.fadeIn(300);
        const [
            costs,
            profits,
        ] = await Promise.all(
            [
                fx('/axcust/getcustcosts', params),
                fx('/axcust/getcustprofits', params),
            ]
        );
        this.processData(costs.documents, profits.documents);
        $overlaySpinner.fadeOut(300);
    }

    processData = (costs, profits) => {
        // ---- results table cleaning
        objLoop(this.results, (k, v, obj) => {
            obj[k] = 0;
        })

        let wzCostData = [];
        let costs_correction_value = 0;
        let costs_correction_count = 0;
        let costs_wz_count = 0;
        let costs_wz_value = 0;
        let wzCostIds = '';

        objLoop(costs, (k, v) => {
            // ---- WZ bez FS
            if (+v.doc_type_id === 28 && +v.child_doc_id === 0 && +v.parent_doc_id === 0) {
                wzCostData.push(v);
                costs_wz_value += parseFloat(v.doc_net_value);
                costs_wz_count++;
                wzCostIds += v.doc_id + ';';
                let dcnv = Math.abs(parseFloat(v.doc_corrections_net_value));
                if (dcnv > 0) {
                    costs_correction_value += dcnv;
                    costs_correction_count++;
                }
            }
        })

        let fsData = [];
        let profit_correction_value = 0;
        let profit_correction_count = 0;
        let profit_fs_count = 0;
        let profit_fs_value = 0;
        let agr_correction_value = 0;
        let agr_correction_count = 0;
        let agr_fs_count = 0;
        let agr_fs_value = 0;
        let fsAgrIds = '';

        objLoop(profits, (k, v) => {
            // ---- FS
            if (+v.doc_type_id === 8) {
                fsData.push(v);
                profit_fs_value += parseFloat(v.doc_net_value);
                profit_fs_count++;
                let dcnv = Math.abs(parseFloat(v.doc_corrections_net_value));
                if (dcnv > 0) {
                    profit_correction_value += dcnv;
                    profit_correction_count++;
                }
            }
            // ---- FS do umów
            if (+v.doc_type_id === 8 && parseFloat(v.doc_items_purchase_value) === 0) {
                agr_fs_value += parseFloat(v.doc_net_value);
                agr_fs_count++;
                fsAgrIds += v.doc_id + ';';
                let dcnv = Math.abs(parseFloat(v.doc_corrections_net_value));
                if (dcnv > 0) {
                    agr_correction_value += dcnv;
                    agr_correction_count++;
                }
            }
        })

        // ---- results
        this.results.costs_wz_value = (costs_wz_value).toFixed(2);
        this.results.costs_wz_count = costs_wz_count;
        this.results.costs_correction_value = (costs_correction_value).toFixed(2);
        this.results.costs_correction_count = costs_correction_count;
        this.results.costs_summary = (costs_wz_value - costs_correction_value).toFixed(2)
        // ----
        this.results.profit_fs_value = (profit_fs_value).toFixed(2);
        this.results.profit_fs_count = profit_fs_count;
        this.results.profit_correction_value = (profit_correction_value).toFixed(2);
        this.results.profit_correction_count = profit_correction_count;
        this.results.profit_summary = (profit_fs_value - profit_correction_value).toFixed(2)
        // ----
        //this.results.agr_fs_value = (agr_fs_value).toFixed(2);
        this.results.agr_fs_count = agr_fs_count;
        this.results.agr_correction_value = (agr_correction_value).toFixed(2);
        this.results.agr_correction_count = agr_correction_count;
        //this.results.agr_summary = (agr_fs_value - agr_correction_value).toFixed(2)
        // ----
        this.refreshTableProfits(fsData);
        this.refreshTableCosts(wzCostData);
        this.fetchDocsItems(wzCostIds, fsAgrIds);

    }

    refreshTableProfits = (profits) => {
        this.tableFsProfitList.clear();
        this.tableFsProfitList.rows.add(profits).draw();
    }

    refreshTableCosts = (costs) => {
        this.tableWzCostList.clear();
        this.tableWzCostList.rows.add(costs).draw();
    }

    fetchDocsItems = async (wzCostIds, fsAgrIds) => {
        $overlaySpinner.fadeIn(300);
        //const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const p1 = {'doc_ids': wzCostIds};
        const p2 = {
            'doc_ids': fsAgrIds,
            'without_services': 0,
            'without_items_ids': '11543' // --- CNU id 11543
        }
        const [
            wz,
            fs,
        ] = await Promise.all(
            [
                fx('/axdoc/getdocsitemsgr', p1),
                fx('/axdoc/getdocsitemsgr', p2),
            ]
        );
        this.refreshTableWZItems(wz.items);
        // ---- wartości FS do umów bez CNU
        let agr_fs_value_cnu = 0;
        objLoop(fs.items, (k, v) => {
            agr_fs_value_cnu += parseFloat(v.item_value);
        })
        this.results.agr_fs_value = (agr_fs_value_cnu).toFixed(2);
        this.results.agr_summary = (agr_fs_value_cnu - this.results.agr_correction_value).toFixed(2)
        this.refreshTableSummary();
        // ----
        $overlaySpinner.fadeOut(300);
    }

    refreshTableWZItems = (items) => {
        this.tableWzItemsList.clear();
        this.tableWzItemsList.rows.add(items).draw();
    }

    refreshTableSummary = () => {
        const self = this;
        this.$containerMain.find('span.data').each(function () {
                const $this = $(this);
                const v = self.results[$this.data('name')];
                if (v !== undefined) {
                    $this.text(v);
                }
            }
        );
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

