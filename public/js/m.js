"use strict";
console.log('start modals');

import {$overlaySpinner, dataTableColumnDef, dataTableInit} from "./c.js";

import {
    fx,
    ax,
    randomString,
    matchingNumericTypes,
    objLoop,
    digitForm, isObjectEmpty,
} from "./f.js";


class MyModal {
    constructor(
        name = 'default',
        input = {},
        parentModal = null,
    ) {
        console.group(`constructor MyModal: ${name}`);
        // -----------------
        console.log('constructor MyModal');
        this.name = name;                       // ---- nazwa modala
        this.input = input
        this.input.modalName = this.name;
        this.myParentModal = parentModal;       // ---- MyModal rodzica
        // -----------------
        console.groupEnd();
    }

    async initialize() {
        console.log('initialize');
        // ----
        this.init = false;
        if (!isObjectEmpty(this.input)) {
            matchingNumericTypes(this.input);
            this.init = true;
            for (let prop in this.input) {
                if ((this.input).hasOwnProperty(prop)) {
                    this.init = this.init && !(this.input[prop] === null || this.input[prop] === undefined || Number.isNaN(this.input[prop]));
                }
            }
        }
        // ----
        if (this.init) {
            $overlaySpinner.fadeIn(300);
            //console.log(this.input);
            const [
                blade,
                data,
            ] = await Promise.all(
                [
                    fx('/axmodal/getModalBlade', this.input),
                    fx('/axmodal/getModalData', this.input),
                ]);
            this.blade = blade;
            this.data = data;
            console.log(this.data);
            // ----
            this.$modalsTemplates = $('#modals-templates');   // ---- kontener na modale
            this.id = randomString(20);                 // ---- id modala
            // ----
            this.$modalsTemplates.append(this.blade);
            this.modalElement = document.getElementById('my-modal-id');
            this.modal = new bootstrap.Modal(this.modalElement, {});
            // ----
            this.$modal = $('#my-modal-id');
            this.$modal.attr('id', this.id);
            this.$modal.attr('data-name', this.name);
            // ----
            this.$dialog = $('.modal-dialog', this.$modal);
            this.$content = $('.modal-content', this.$modal);
            this.$header = $('.modal-header', this.$modal);
            this.$title = $('.modal-title', this.$modal);
            this.$body = $('.modal-body', this.$modal);
            this.$footer = $('.modal-footer', this.$modal);
            this.$btnClose = $('button[data-name=btn-close]', this.$modal);
            // ----
            // ---- czy jestem potomkiem
            // ---- czy ten modal został wywołany z innego modala
            this.selfIsChild = !!(this.myParentModal);
            // ---- jeżeli jestem potomkiem to mój rodzic ma potomka
            if (this.selfIsChild) this.myParentModal.selfHasChild = !!(this.selfIsChild);
            // ---- czy z tego modala wywołano kolejny modal
            // ---- jeszcze nie mam potomka
            this.selfHasChild = false;
            // ---- kasujemy ten modal czy tylko ukrywamy
            // ---- nowy modal domyślnie kasujemy bo nie ma potomków
            this.selfRemove = !this.selfHasChild;
            // ----
            // ---- rejestr tablic typu dataTables wykorzystany w porządkach
            this.dataTablesList = {};
            // ----
            // ---- jeżeli modal zawiera bootstrap tabs
            // ---- ogarniamy aby zapobiec zdublowaniu attr id
            // ---- domyślne kontener tabs <div id="tabs">
            this.tabs = [];
            this.tabsCollection = this.$body.find('div#tabs');
            this.tabsCollection.each((index, element) => {
                    this.tabs[index] = [];
                    let $element = $(element);
                    let newId = 'tabs-' + randomString(20);
                    $element.attr('id', newId);
                    let triggerTabList = [].slice.call(document.querySelectorAll('#' + newId + ' a'))
                    // ---- podmieniamy id tabsom i linkom
                    triggerTabList.forEach((triggerEl) => {
                        let $triggerEl = $(triggerEl);
                        let href = $triggerEl.attr('href');
                        let $tab = $('div' + href);
                        $tab.attr('data-id', href.replace('#', ''));
                        let id = href + '-' + randomString(5);
                        $triggerEl.attr('href', id);
                        $tab.attr('id', id.replace('#', ''));
                        // ---- wskaźniki na zakładki do tablicy
                        this.tabs[index].push(new bootstrap.Tab(triggerEl));
                    })
                }
            )
            //console.log(this.tabs);
            // ----
            // ---- moja logika po ukryciu modala pod eventem hidden.bs.modal
            $(this.modalElement).on('hidden.bs.modal', this.myClean.bind(this));
            // ----
            this.myContent();
            $overlaySpinner.fadeOut(300);
        } else {
            console.log('Błędne dane wejściowe modala!!!');
        }
    }

    myShow = (callback = null) => {
        // ---- pokazuję modala tylko gdy nie ma potomka
        if (this.selfHasChild === false) {
            if (callback) callback.apply(this);
            this.modal.show();
        }
        // ---- jak mam rodzica to go tylko ukrywam
        if (this.selfIsChild === true) {
            this.myParentModal.selfRemove = false;
            this.myParentModal.myHide();
        }
    }

    myHide = () => {
        this.modal.hide();
    }

    /**
     * event hidden.bs.modal wywołuje procedurę oczyszczania
     */
    myClean = () => {
        // ---- remove warning
        // ---- Blocked aria-hidden on an element because its descendant retained focus.
        if (document.activeElement) {
            document.activeElement.blur();
        }
        const clean = () => {
            for (let n in this.dataTablesList) {
                this.dataTablesList[n].destroy();
            }
            $(this.modalElement).off();
            this.modal.dispose();
            this.$modal.remove();
        }
        // ---- nie mam rodzica i ustawioną flagę kasowania
        if (this.selfIsChild === false && this.selfRemove === true) {
            clean.apply(this); // ---- usuwam całkowicie siebie
        }
        // ---- mam rodzica i ustawioną flagę kasowania
        // ---- ogarniam rdzica
        if (this.selfIsChild === true && this.selfRemove === true) {
            this.myParentModal.selfHasChild = false;   // ---- mój rodzic nie ma już potomka
            this.myParentModal.selfRemove = true;      // ---- mój rodzic może już zostać skasowany
            this.myParentModal.myShow();               // ---- odkrywam rodzica
            clean.apply(this);                         // ---- usuwam całkowicie siebie
        }
    }

    /**
     * podpięcie się pod event hidden.bs.modal
     * zamknięcie modala wywoła callback
     * @param callback
     */
    myHiddenHandler(callback = null) {
        if (callback) $(this.modalElement).on('hidden.bs.modal', callback.bind(this));
    }


    myContent = () => {
        switch (this.name) {
            case 'altumDocument':
                this.altumDocument();
                break
            case 'agreement':
                this.agreement();
                break
            case 'device':
                this.device();
                break

            default:
                console.log('dupa z kota !!!');
        }
        this.myShow();
    }

    /**
     * ------------------------------------------------------------------------------------------
     * ------------------------------------------------------------------------------------------
     *  -------------- helpers
     */

    setDocHeaderData(h) {
        const header = {
            'netValue': {
                'value': digitForm((h.doc_net_value).toFixed(2)),
                'label': 'Netto PLN',
                'hidden': false
            },
            'grossValue': {
                'value': digitForm((h.doc_gross_value).toFixed(2)),
                'label': 'Brutto PLN',
                'hidden': false
            },
            'sourceNo': {
                'value': h.doc_source_no,
                'label': 'Numer obcy',
                'hidden': false
            },
            'customer1': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'customer2': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'date1': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'date2': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'date3': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'store1': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'store2': {
                'value': '',
                'label': '',
                'hidden': false
            },
            'paymentFormName': {
                'value': h.doc_payment_form_txt,
                'label': 'Płatność',
                'hidden': false
            },
            'datePayment': {
                'value': h.doc_date_payment,
                'label': 'Termin',
                'hidden': false
            },
            'companyUnitName': {
                'value': h.company_unit_txt,
                'label': 'Właściciel',
                'hidden': false
            },
            'assistant': {
                'value': h.doc_assistant,
                'label': 'Obsługujący',
                'hidden': false
            },
            'description': {
                'value': h.doc_description,
                'label': 'Opis',
                'hidden': false
            },
        };
        const docTypeId = parseInt(h.doc_types_id);
        switch (docTypeId) {
            case 5: // PW
                break;
            case 6: // RW
                break;
            case 7: // FZ
                break;
            case 8: // FS
                header.customer1.value = h.purchaser_name;
                header.customer1.label = 'Nabywca';
                header.customer2.value = h.recipient_name;
                header.customer2.label = 'Odbiorca';
                header.date1.value = h.doc_date;
                header.date1.label = 'Data wystawienia';
                header.date2.value = h.doc_date_selling;
                header.date2.label = 'Data sprzedaży';
                header.date3.hidden = true;
                header.store1.value = h.source_store_name;
                header.store1.label = 'Magazyn';
                header.store2.hidden = true;
                break;
            case 13: // ZS
                header.sourceNo.value = h.doc_source_no;
                header.sourceNo.label = 'Źródło';
                header.customer1.value = h.purchaser_name;
                header.customer1.label = 'Nabywca';
                header.customer2.value = h.recipient_name;
                header.customer2.label = 'Odbiorca';
                header.date1.value = h.doc_date;
                header.date1.label = 'Data wystawienia';
                header.date2.value = h.doc_date_purchase;
                header.date2.label = 'Data aktywacji';
                header.date3.value = h.doc_date_purchase;
                header.date3.label = 'Data realizacji';
                header.store1.value = h.doc_date_receipt;
                header.store1.label = 'Magazyn';
                header.store2.hidden = true;
                break;
            case 17: // MM+
                break;
            case 18: // MM-
                break;
            case 28: // WZ
                header.customer1.value = h.purchaser_name;
                header.customer1.label = 'Nabywca';
                header.customer2.value = h.recipient_name;
                header.customer2.label = 'Odbiorca';
                header.date1.value = h.doc_date;
                header.date1.label = 'Data wystawienia';
                header.date2.value = h.doc_date_storeope;
                header.date2.label = 'Data wydania';
                header.date3.hidden = true;
                header.store1.value = h.source_store_name;
                header.store1.label = 'Magazyn';
                header.store2.hidden = true;
                break;
            case 31: // PZ
                break;
            case 85: // ZWE
                header.sourceNo.hidden = true;
                header.customer1.hidden = true;
                header.customer2.hidden = true;
                header.store1.value = h.source_store_name;
                header.store1.label = 'Magazyn źródłowy';
                header.store2.value = h.target_store_name;
                header.store2.label = 'Magazyn docelowy';
                header.date1.value = h.doc_date;
                header.date1.label = 'Data wystawienia';
                header.date2.value = h.doc_date_storeope;
                header.date2.label = 'Data aktywacji rezerwacji';
                header.date3.value = h.doc_date_receipt;
                header.date3.label = 'Data realizacji';
                header.paymentFormName.hidden = true;
                header.datePayment.hidden = true;
                break;

            default:
                header.assistant.value = 'dupa z kota';
        }

        for (let n in header) {
            let i = header[n];
            let $n = this.$body.find('#' + n);
            if ($n.length) {
                $n.find('label').text(i.label);
                let $input = $n.find('input');
                $input = $input.length ? $input : $n.find('textarea');
                $input.val(i.value);
                if (i.hidden) {
                    $n.addClass('d-none');
                } else {
                    $n.removeClass('d-none');
                }
            }
        }
    }


    /**
     * ------------------------------------------------------------------------------------------
     * ------------------------------------------------------------------------------------------
     * ------------- content methods
     */

    altumDocument = () => {
        const header = this.data.header
        matchingNumericTypes(header);
        // ----
        this.$title.children('.doc_no').text(header.doc_no);
        this.$title.children('.status').text(header.doc_status_txt);
        // ----
        this.setDocHeaderData(header);
        // ----
        this.$tableDocContent = this.$body.find('table[data-name=table-doc-content]');
        this.tableDocContentInit = {
            ...dataTableInit,
            rowId: 'art_id',
            paging: false,
            autoWidth: false,
            searching: false,
            info: false,
            order: [[0, 'asc']],
            columns: [
                {data: 'item_no'},     // --- 0
                {data: 'art_code'},        // --- 1
                {data: 'art_name'},         // --- 2
                {data: 'item_quantity'},    // --- 3
                {data: 'item_price'},      // --- 4
                {data: 'item_value'},      // --- 5
            ],
        }
        this.tableDocContent = this.$tableDocContent.DataTable(this.tableDocContentInit);
        this.dataTablesList['tableDocContent'] = this.tableDocContent
        this.tableDocContent.rows.add(this.data.items).draw();
    }

    agreement = () => {
        console.log('agreement content');
        // ---- ------------------------------------------------------------------------
        // -------- tabele -----------------------------------------------------------------
        // ---- stawki
        this.$tableAgrRates = this.$body.find('table[data-name=table-agr-rates');
        this.tableAgrRatesInit = {
            ...dataTableInit,
            rowId: 'art_id',
            paging: false,
            autoWidth: false,
            searching: false,
            info: false,
            order: [[0, 'asc']],
            columns: [
                {data: 'rate_position'},                    // --- 0
                {data: 'art_code'},                         // --- 1
                {data: 'art_name'},                         // --- 2
                {data: 'rate_rate'},                        // --- 3
                {data: 'rate_is_counter_service_txt'},      // --- 4
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    width: '5%',
                },
                {
                    ...dataTableColumnDef,
                    targets: [3],
                    className: 'ellipsis',
                    width: '10%',
                    type: 'num',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(4);
                        } else {
                            return cellData;
                        }
                    }
                },
                {
                    ...dataTableColumnDef,
                    targets: [4],
                    width: '10%',
                    className: 'text-center'
                },
            ],
        }
        this.tableAgrRates = this.$tableAgrRates.DataTable(this.tableAgrRatesInit);
        this.dataTablesList['tableAgrRates'] = this.tableAgrRates
        this.tableAgrRates.rows.add(this.data.itemRates).draw();
        // ---- itemy
        this.$tableAgrItems = this.$body.find('table[data-name=table-agr-items');
        this.tableAgrItemsInit = {
            ...dataTableInit,
            rowId: 'agr_item_dev_id',
            paging: false,
            autoWidth: false,
            searching: true,
            info: false,
            order: [[0, 'asc']],
            columns: [
                {data: null},                                    // --- 0
                {data: 'agr_item_art_name'},                     // --- 1
                {data: 'agr_item_serial_name'},                  // --- 2
                {data: 'agr_item_serial_no'},                    // --- 3
                {data: 'agr_item_status_txt'},                   // --- 4
                {data: 'agr_item_replacement_parts_kind_txt'},   // --- 5
                {data: 'agr_item_billing_if_no_counter_txt'},    // --- 6
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    width: '5%',
                    render: function (cellData, type, rowData, meta) {
                        if (type === 'display') {
                            return meta.row + 1;
                        } else {
                            return cellData;
                        }
                    }
                },
            ],
        }
        this.tableAgrItems = this.$tableAgrItems.DataTable(this.tableAgrItemsInit);
        this.dataTablesList['tableAgrItems'] = this.tableAgrItems
        this.tableAgrItems.rows.add(this.data.items).draw();
        // ---- faktury
        this.$tableAgrInvoices = this.$body.find('table[data-name=table-agr-invoices');
        this.tableAgrInvoicesInit = {
            ...dataTableInit,
            rowId: 'doc_id',
            paging: false,
            autoWidth: false,
            searching: true,
            info: false,
            order: [[0, 'asc']],
            columns: [
                {data: null},                                    // --- 0
                {data: 'doc_no'},                     // --- 1
                {data: 'doc_document_date'},                  // --- 2
                {data: 'doc_net_value'},                    // --- 3
                {data: 'billing_date_from'},                   // --- 4
                {data: 'billing_date_to'},   // --- 5
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [0],
                    width: '5%',
                    render: function (cellData, type, rowData, meta) {
                        if (type === 'display') {
                            return meta.row + 1;
                        } else {
                            return cellData;
                        }
                    }
                },
            ],
        }
        this.tableAgrInvoices = this.$tableAgrInvoices.DataTable(this.tableAgrInvoicesInit);
        this.dataTablesList['tableAgrInvoices'] = this.tableAgrInvoices
        this.tableAgrInvoices.rows.add(this.data.invoices).draw();
        this.$tableAgrInvoices.on('click', 'tr', async (e) => {
            const id = parseInt($(e.currentTarget).attr('id'));
            const modal = new MyModal('altumDocument', {'doc_id': id}, this);
            await modal.initialize();
        })
        // ---- historia
        this.$tableAgrHistory = this.$body.find('table[data-name=table-agr-history');
        this.tableAgrHistoryInit = {
            ...dataTableInit,
            columns: [
                {data: 'object_type'},                     // --- 0
                {data: 'change_type'},                     // --- 1
                {data: 'additional_data'},                  // --- 2
                {data: 'employee_name'},                    // --- 3
                {data: 'date'},                   // --- 4
            ],
            columnDefs: [],
        }
        this.tableAgrHistory = this.$tableAgrHistory.DataTable(this.tableAgrHistoryInit);
        this.dataTablesList['tableAgrHistory'] = this.tableAgrHistory
        this.tableAgrHistory.rows.add(this.data.history).draw();

        // ---- ------------------------------------------------------------------------
        // ---- header
        const header = this.data.header
        matchingNumericTypes(header);
        this.$title.children('.agr_no').text(header.agr_no);
        this.$title.children('.status').text(header.agr_status_txt);
        // ----
        this.$body.find('div[data-id=header] input[type=text]').each(function () {
                const $this = $(this);
                const v = header[$this.attr('name')];
                if (v !== undefined) {
                    $this.val(v);
                }
            }
        );
        // ---- ------------------------------------------------------------------------
        // ---- parameters
        const params = this.data.itemParams;
        matchingNumericTypes(params);
        this.$body.find('div[data-id=parameters] input[type=text]').each(function () {
                const $this = $(this);
                const v = params[$this.attr('name')];
                if (v !== undefined) {
                    $this.val(v);
                }
            }
        );

    }

    device = () => {
        console.log('device content');
        // ---- ------------------------------------------------------------------------


    }

    }

export {
    MyModal,
}
