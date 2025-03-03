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
    ax, fx, getParametersFromForm,
} from "../f.js";
import {MyModal} from "../m.js";

// ---- modale
// import {
// } from "../m.js";

class AliasesList {

    /**
     * @param data
     */
    constructor(data) {
        console.clear();
        console.group(`constructor: AliasesList`);
        const self = this;
        this.data = data;
        //console.log(this.data);
        this.$containerMain = $('div[data-name=container-main]');
        this.$sectionFilters = this.$containerMain.find('section[data-name=filters-tab-00]');
        this.$btnSearch = this.$containerMain.find('button[name=btn-search]');

        this.$tableAliasList = this.$containerMain.find('table[data-name=table-alias-list]');
        let tableAliasListInit = {
            ...dataTableInit,
            autoWidth: false,
            rowId: 'address',
            columns: [
                {data: 'address'},   // --- 0
                {data: 'goto'},      // --- 1
                {data: 'active'},    // --- 2
            ],
            createdRow: function (row, data, dataIndex) {
                // if (data.current_agr_status_txt === 'aktywna' && (+data.ai_installation_address_status !== 1 || +data.ai_toner_address_status !== 1)) {
                //     $(row).find('td').addClass('text-danger');
                // }
            },
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    //width: '5%',
                    className: 'ellipsis',
                },
                {
                    ...dataTableColumnDef,
                    targets: [1],
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            let aGoto = cellData.split(',');
                            let c = '';
                            for (const el of aGoto) {
                                c += el + '<br>';
                            }
                            return c;
                        } else {
                            return cellData;
                        }
                    },
                    createdCell: function (td, cellData, rowData, row, col) {
                        // $(td).on('click', (e) => {
                        //         self.actions($(e.target).data('name'), rowData, td);
                        //     }
                        // );
                    },

                },
                {
                    ...dataTableColumnDef,
                    targets: [2],
                    //className: 'ellipsis',
                },

            ],
        }
        this.tableAliasList = this.$tableAliasList.DataTable(tableAliasListInit);
        // -----------------
        //this.tableAliasList.on('click', 'tbody > tr', this.showWC);
        // -----------------
        this.$btnSearch.on('click', this.getAliases);
        // -----------------
        console.groupEnd();
    }

    showAlias = async (e) => {
        console.log('showAlias');
        e.preventDefault();
        // const id = +e.currentTarget.id;
        // if (!isNaN(id) && id > 0) {
        //     const modal = new MyModal('work-card', {'wc_id': id});
        //     await modal.initialize();
        // }
    }

    getAliases = () => {
        console.log('getAliases');
        const params = getParametersFromForm(this.$sectionFilters);
        if (params.aActive && !params.aInactive) {
            params.pActive = 1
        } else if (!params.aActive && params.aInactive) {
            params.pActive = 0
        } else {
            params.pActive = -1
        }
        console.log(params)
        this.fetchAliases(params);
    }

    fetchAliases = async (params) => {
        let uri = '/axit/getaliases';
        $overlaySpinner.fadeIn(300);
        const [data,] = await Promise.all([fx(uri, params),]);
        console.log(data);
        this.refreshTableAliases(data);
        $overlaySpinner.fadeOut(300);
    }

    refreshTableAliases = (aliases) => {
        this.tableAliasList.clear();
        this.tableAliasList.rows.add(aliases).draw();
    }


}


class DynamicTablesList {
    /**
     * @param data
     */
    constructor(data) {
        //console.clear();
        console.group(`constructor: DynamicTablesList`);
        const self = this;
        this.data = data;
        console.log(this.data);
        this.$containerMain = $('div[data-name=container-main]');
        // -----------------
        this.$tableDynamicTablesList = this.$containerMain.find('table[data-name=table-dynamic-tables-list]');
        let tableDynamicTablesListInit = {
            ...dataTableInit,
            rowId: 'id',
            createdRow: function (row, data, dataIndex) {
            },
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: 0,
                    data: 'id',
                    name: 'id',
                    title: 'ID',
                    //className: 'ellipsis',
                },
                {
                    ...dataTableColumnDef,
                    targets: 1,
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                },
                {
                    ...dataTableColumnDef,
                    targets: 2,
                    data: 'data_name',
                    name: 'data_name',
                    title: 'DataName',
                },
                {
                    ...dataTableColumnDef,
                    targets: 3,
                    data: 'view_path',
                    name: 'view_path',
                    title: 'View path',
                },
                {
                    ...dataTableColumnDef,
                    targets: 4,
                    data: 'view_name',
                    name: 'view_name',
                    title: 'View name',
                },
                {
                    ...dataTableColumnDef,
                    targets: 5,
                    data: null,
                    name: 'actions',
                    title: 'Actions',
                    orderable: false,
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            let a = '';
                            a += '&nbsp;' + '<a href="#" data-name="show" class="btn btn-warning btn-sm"><i data-name="show" class="bi bi-eye"></i>&nbsp;Pokaż</a>';
                            a += '&nbsp;' + '<a href="#" data-name="edit" class="btn btn-primary btn-sm"><i data-name="edit" class="bi bi-pencil-square"></i>&nbsp;Edytuj</a>';
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
        this.tableDynamicTablesList = this.$tableDynamicTablesList.DataTable(tableDynamicTablesListInit);
        this.tableDynamicTablesList.rows.add(data.tables).draw();
        // -----------------
        console.groupEnd();
    }

    /**
     * Actions on the table
     * @param action - action name
     * @param tableData - supported table data
     * @param td - pointer to the cell generating the event
     */
    actions = (action, tableData, td) => {
        switch (action) {
            case 'show':
                location.href = '/dynamic-tables/' + tableData.id;
                break;
            case 'edit':
                location.href = '/dynamic-tables/' + tableData.id + '/edit';
                break;
            default:
                console.log(`DynamicTablesList.actions unknown action = ${action}`);
        }
    }


}


class DynamicTableColumnUpdate {
    constructor() {
        //console.clear();
        console.group(`constructor: DynamicTableColumnUpdate`);
        // -----------------
        const self = this;
        this.$containerMain = $('div[data-name=container-main]');
        this.$tableColumnsList = this.$containerMain.find('table[data-name=table-columns-list]')
        this.$tableColumnsList.on('click', 'td.save', function (e) {
            const $tr = $(e.target).closest('tr');
            const params = getParametersFromForm($tr);
            self.update(params, $tr)
        })
        // -----------------
        console.groupEnd();
    }

    update = async (params, $tr) => {
        let uri = '/axdtc/columnupdate';
        const [data,] = await Promise.all([fx(uri, params),]);
        const $mbox = $tr.find('div.message');
        if(data){
            $mbox.append('<span class=""><i class="bi bi-check-circle text-success"></i></span>');
        } else {
            $mbox.append('<span class=""><i class="bi bi-exclamation-circle text-danger"></i></span>');
        }
        $mbox.show().delay(4000).hide(0, () => {
            $mbox.html('');
        });
    }
}

// //// ---------------------------------------------------------------------------------------------
// //// ----------------------------------------------------------------------------------------------
export {
    AliasesList,
    DynamicTablesList,
    DynamicTableColumnUpdate,
}
