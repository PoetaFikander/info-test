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
    getParametersFromForm, objLoop,
    selectOptionAdd,
} from "../f.js";

// ---- modale
// import {
// } from "../m.js";

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
        this.$formFilters = $('form[name=filters]', this.$containerMain);
        this.$selectPatrons = $('select[name=patron_altum_id]', this.$containerMain)

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
        // -----------------
        console.groupEnd();
    }

    getBasicReport = () => {
        const self = this;
        //console.log('getReport');
        //console.log(getParametersFromForm(this.$formFilters));
        const params = getParametersFromForm(this.$formFilters);
        $overlaySpinner.fadeIn(300);
        ax(
            params,
            '/axreportsmif/getbasicreport',
            function (data) {
                console.log(data);
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

        //this.tableMifList = this.$tableMifList.DataTable();
        this.tableMifList = this.$tableMifList.DataTable(tableMifListInit);

    }

}

// //// ---------------------------------------------------------------------------------------------
// //// ----------------------------------------------------------------------------------------------
export {
    MifCompany,
}

