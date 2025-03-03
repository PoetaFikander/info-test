"use strict";
console.log('start modals');

import {$overlaySpinner, dataTableColumnDef, dataTableInit} from "./c.js";

import {
    fx,
    ax,
    randomString,
    matchingNumericTypes,
    objLoop,
    digitForm,
    isObjectEmpty,
    getParametersFromForm,
    isFloat,
    CUD,
} from "./f.js";


class MyModal {
    constructor(
        name = 'default',
        input = {},
        parentModal = null,
        hideParentModal = true,
    ) {
        console.clear();
        console.group(`constructor MyModal: ${name}`);
        // -----------------
        console.log('constructor MyModal');
        this.name = name;                           // ---- nazwa modala
        this.input = input
        this.input.modalName = this.name;
        this.myParentModal = parentModal;           // ---- MyModal rodzica
        this.hideMyParentModal = hideParentModal;   // ---- czy ukrywać rodzica
        // -----------------
        console.groupEnd();
    }

    async initialize() {
        console.log('modal initialize data');
        console.log(this.input)
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
            //console.log('Modal data:');
            //console.log(this.data);
            // ----
            this.$modalsTemplates = $('#modals-templates');   // ---- kontener na modale
            this.id = randomString(20);                 // ---- id modala
            // ----
            this.$modalsTemplates.append(this.blade);
            this.modalElement = document.getElementById('my-modal-id');
            this.modal = new bootstrap.Modal(this.modalElement, {backdrop: "static"});
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
            // ---- z-index handling
            $(this.modalElement).on('show.bs.modal', this.zIndexAfterShow.bind(this));
            $(this.modalElement).on('hide.bs.modal', this.zIndexAfterHide.bind(this));
            // --------------------------------------------------------------------
            // ----
            this.myContent();
            $overlaySpinner.fadeOut(300);
        } else {
            console.log('Błędne dane wejściowe modala!!!');
        }
    }

    zIndexAfterShow = () => {
        if (this.selfIsChild && !this.hideMyParentModal) {
            this.myParentModal.$modal.css('z-index', 1045);
        }
    }

    zIndexAfterHide = () => {
        if (this.selfIsChild && !this.hideMyParentModal) {
            this.myParentModal.$modal.css('z-index', 1055);
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
            if (this.hideMyParentModal) {
                this.myParentModal.myHide();
            }
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
        //if (this.selfIsChild === true && this.selfRemove === true) {
        if (this.selfIsChild === true) {
            if (this.selfRemove === true) {
                this.myParentModal.selfHasChild = false;   // ---- mój rodzic nie ma już potomka
                this.myParentModal.selfRemove = true;      // ---- mój rodzic może już zostać skasowany
                if (this.hideMyParentModal) {
                    this.myParentModal.myShow();           // ---- odkrywam rodzica
                }
                clean.apply(this);                         // ---- usuwam całkowicie siebie
            }
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
            case 'native-document':
                this.nativeDocument();
                break
            case 'agreement':
                this.agreement();
                break
            case 'device':
                this.device();
                break
            case 'work-card':
                this.workCard();
                break
            // -----------------------------------------
            // ---- update rate
            case 'update-rate':
                this.updateRate();
                break
            // ---- universal update
            case 'update-select':
            case 'update-date':
            case 'update-text':
            case 'update-textarea':
                this.updateModal();
                break

            default:
                console.log('dupa z kota !!!');
        }
        this.myShow();
    }

    /**
     *  -------------- helpers ------------------------------------------------------------------
     */

    /* ----------------------------------------------------------------------------------------- */

    /* ----------------- nativeDocument -------------------------------------------------------- */
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

    /* ----------------------------------------------------------------------------------------- */
    /* ----------------- update dev ai rate ---------------------------------------------------- */
    updateRateModalInit = async (e) => {
        console.log('update rate modal init');
        const rateId = +$(e.currentTarget).parent().parent().attr('id');
        const input = {
            rateId: rateId,
            ai: this.data.device,
        }
        const modal = new MyModal('update-rate', input, this, false);
        await modal.initialize();
    }

    updateRate = () => {
        console.log('update rate');
        //console.log(this.input);
        //console.log(this.data);
        const rateId = +this.input.rateId;
        const rate = this.data.result.rates[rateId];
        const rateIsCounter = !!(+rate.rate_is_counter)
        //const aiExtraValueInCNU = +this.input.ai.ai_extra_value_in_cnu;
        //const aiExtraValueServiceId = +this.input.ai.ai_extra_value_service_id;

        // ---- ------------------------------------------------------------------------
        // ---- title
        let headerTxt = '';
        headerTxt += '<span class="fs-7">\xa0\xa0\xa0\xa0\xa0urządzenie:\xa0\xa0</span>'
            + '<span class="fs-4">' + this.input.ai.dev_serial_no + '</span>';
        headerTxt += '<span class="fs-7">\xa0\xa0\xa0\xa0\xa0usługa:\xa0\xa0</span>'
            + '<span class="fs-4">' + rate.rate_code + '</span>';
        this.$title.html(headerTxt);
        // ---- ------------------------------------------------------------------------
        // ----
        const $selectCompanyUnits = this.$body.find('select[name=rate_company_unit_id]');
        objLoop(this.data.result.companyUnits, (k, v) => {
            let option = '<option value="' + v.unit_id + '">' + v.unit_name + '</option>';
            $selectCompanyUnits.append(option);
        })

        this.$body.find('input.old, textarea.old').each(function () {
                const $this = $(this);
                let name = ($this.attr('name')).substring(4);
                let v = rate[name];
                if (name === 'rate_value' && isFloat(v)) {
                    v = parseFloat(v).toFixed(4)
                }
                if (v !== undefined) {
                    $this.val(v);
                }
            }
        );

        this.$body.find('input, select, textarea').each(function () {
                const $this = $(this);
                let name = $this.attr('name');
                let v = rate[name];
                if (name === 'rate_value' && isFloat(v)) {
                    v = parseFloat(v).toFixed(4)
                }
                if (v !== undefined) {
                    $this.val(v);
                }
            }
        );
        // ---------------------------------------------------------------------------------
        if (!rateIsCounter) {
            this.$body.find('input[name=rate_free_copies_in_cnu').prop('disabled', true);
        }

        // ---------------------------------------------------------------------------------
        // ---- ai params
        // const $selectExtraValueServiceId = this.$body.find('select[name=ai_extra_value_service_id]');
        // objLoop(this.data.art, (k, v) => {
        //     let option = '<option value="' + v.id + '">' + v.txt + '</option>';
        //     $selectExtraValueServiceId.append(option);
        // })
        // $selectExtraValueServiceId.val(aiExtraValueServiceId);
        // const $selectExtraValueInCNU = this.$body.find('select[name=ai_extra_value_in_cnu]');
        // $selectExtraValueInCNU.val(aiExtraValueInCNU);
        // const $selectIsLumpSum = this.$body.find('select[name=rate_is_lump_sum');
        // ---------------------------------------------------------------------------------
        // ---- ograniczenia
        // $selectIsLumpSum.prop('disabled', true);
        // $selectExtraValueInCNU.prop('disabled', true);
        // ----
        // $selectExtraValueServiceId.on('change', (e) => {
        //     if (+$selectExtraValueServiceId.val() > 0) {
        //         $selectExtraValueInCNU.prop('disabled', false);
        //     } else {
        //         $selectExtraValueInCNU.prop('disabled', true);
        //         $selectExtraValueInCNU.val(0);
        //         $selectIsLumpSum.val(0);
        //     }
        // })
        //$selectExtraValueServiceId.trigger('change');
        // ----
        // $selectExtraValueInCNU.on('change', (e) => {
        //     if (+$selectExtraValueInCNU.val() === 1) {
        //         $selectIsLumpSum.val(1);
        //     } else {
        //         $selectIsLumpSum.val(0);
        //     }
        // })
        // if (rateIsCounter) {
        //     this.$body.find('div.ai-params').hide();
        // }
        // ---------------------------------------------------------------------------------
        // ---- save
        const save = async (e) => {
            e.preventDefault();
            console.log('save rate');
            // ----
            const params = getParametersFromForm(this.$body.find('section[data-name=filters]'));
            const input = {
                ...this.input,
                ...params,
            };
            // ----
            $overlaySpinner.fadeIn(300);
            const [
                data,
            ] = await Promise.all(
                [
                    fx('/axagr/upagritemrate', input),
                ]);
            this.myParentModal.refreshAgrItemRates(data);
            $overlaySpinner.fadeOut(300);
            // ----
            this.myHide();
        }
        this.$footer.find('button[data-name=btn-save]').on('click', save);

    }

    /* ----------------------------------------------------------------------------------------- */
    /* ----------------- universal update modals -------------------------------------------------------------- */
    updateModalInit = async (e) => {
        console.log('update modal init');
        const $trigger = $(e.currentTarget);
        const $parentInput = $trigger.parents('.input-group').find('[data-value-type]');
        const updateData = {
            name: $trigger.data('name'),
            columnLabel: $parentInput.data('label'),
            columnName: $parentInput.attr('name'),
            valueType: $parentInput.data('value-type'),
            currentValueTxt: $parentInput.val(),
        }
        const input = {
            updateData: updateData,
            currentData: this.data.device,
        }
        const modal = new MyModal('update-' + updateData.valueType, input, this, false);
        await modal.initialize();
    }

    updateModal = () => {
        console.log('update universal data');
        console.log(this.data);
        const columnName = this.input.updateData.columnName;
        const columnLabel = this.input.updateData.columnLabel;
        const currentValueTxt = this.input.updateData.currentValueTxt;
        const valueType = this.input.updateData.valueType;
        // ---------------- modal size -----------------------------------------------------
        const greaterModals = [
            'ai_description',
            'ai_toner_address',
            'ai_toner_address_add_data',
            'ai_installation_address',
            'ai_installation_address_add_data',
        ];
        if (greaterModals.indexOf(columnName) !== -1) {
            this.$dialog.addClass('modal-lg');
        }
        // ----------------------------------------------------------------------------------
        // ---- title
        this.$title.text(columnLabel);
        // ---- current value for input[text,date], select
        this.$body.find('input[name=current_value_txt]').val(currentValueTxt);
        // ---- current value for textarea
        this.$body.find('textarea[name=current_value_txt]').text(currentValueTxt);
        // ---------------- text -----------------------------------------------------------
        if (valueType === 'text') {
            let newValue = (currentValueTxt === 'nie wybrano') ? '' : currentValueTxt;
            this.$body.find('input[name=new_value]').val(newValue);
        }
        // ---------------- select ---------------------------------------------------------
        if (valueType === 'select') {
            const $selectValues = this.$body.find('select[name=new_value]');
            objLoop(this.data.result, (k, v) => {
                let selected = (v.txt === currentValueTxt) ? ' selected' : '';
                // style="font-family: 'Courier New', monospace !important;"
                let option = '<option value="' + v.id + '"' + selected + '>' + v.txt + '</option>';
                $selectValues.append(option);
            })
        }
        // ---------------- textarea -----------------------------------------------------------
        if (valueType === 'textarea') {
            this.$body.find('textarea[name=new_value]').text(currentValueTxt);
        }
        // ---------------------------------------------------------------------------------
        // ---- save
        const save = async (e) => {
            e.preventDefault();
            const params = getParametersFromForm(this.$body.find('section[data-name=filters]'));
            const input = {
                ...this.input,
                dataFromForm: params,
            };
            // -----------------------------------------
            $overlaySpinner.fadeIn(300);
            const [
                data,
            ] = await Promise.all(
                [
                    fx('/axuniupdate', input),
                ]);
            $overlaySpinner.fadeOut(300);
            // -----------------------------------------
            this.myParentModal.refreshAfterUpdate(data);
            this.myHide();
        }
        this.$footer.find('button[data-name=btn-save]').on('click', save);
    }
    /* ----------------------------------------------------------------------------------------- */

    /**
     * ------------------------------------------------------------------------------------------
     * ------------------------------------------------------------------------------------------
     * ------------- modals content methods -----------------------------------------------------
     */

    /* ----------------------------------------------------------------------------------------- */
    device = () => {
        console.log('device content');
        console.log(this.data);
        // -----------------------------------------------------------------------------
        // ---- update from modals
        this.refreshAfterUpdate = (data) => {
            //console.clear();
            console.log('refreshAfterUpdate');
            switch (data.updateData.name) {
                case 'ai':
                case 'device':
                    this.refreshParameters(data)
                    break;
                default:
                    console.log('dupa z kota')
            }
        }
        // -----------------------------------------------------------------------------
        this.refreshModalContent = () => {
            //const self = this;
            const device = this.data.device;
            // ---- tab1, tab5, tab6  pola powiązane z ai
            this.$body.find(
                'input, textarea'
            ).each(function () {
                    const $this = $(this);
                    const v = device[$this.attr('name')];
                    if (v !== undefined) {
                        $this.val(v);
                    }
                }
            );
            // ---- tab6 dev Addresses
            if (device.ai_installation_address_status_txt === 'aktywny') {
                this.$instAddrStatus.text(device.ai_installation_address_status_txt);
                this.$instAddrLegend.css('color', '#61f306');
            } else if (device.ai_installation_address_status_txt === 'nieaktywny') {
                this.$instAddrStatus.text(device.ai_installation_address_status_txt);
                this.$instAddrLegend.css('color', '#e80d26');
            } else {
                this.$instAddrStatus.text('brak adresu');
                this.$instAddrLegend.css('color', '#e80d26');
            }
            if (device.ai_toner_address_status_txt === 'aktywny') {
                this.$tonerAddrStatus.text(device.ai_toner_address_status_txt);
                this.$tonerAddrLegend.css('color', '#61f306');
            } else if (device.ai_toner_address_status_txt === 'nieaktywny') {
                this.$tonerAddrStatus.text(device.ai_toner_address_status_txt);
                this.$tonerAddrLegend.css('color', '#e80d26');
            } else {
                this.$tonerAddrStatus.text('brak adresu');
                this.$tonerAddrLegend.css('color', '#e80d26');
            }
            if (this.isCurrentAgreement) {
                // ---- tabelka stawek
                this.tableRates.clear();
                this.tableRates.rows.add(this.data.itemRates).draw();
            }
        }
        // -----------------------------------------------------------------------------
        // ---- update from modals
        this.refreshAgrItemRates = (data) => {
            console.log('refreshAgrItemRates');
            this.data.itemRates = data.result;
            this.refreshModalContent();
        }
        // ----
        this.refreshParameters = (data) => {
            console.log('refreshAgrItemParameters');
            this.data.device = {
                ...data.result
            };
            this.refreshModalContent();
        }
        // -----------------------------------------------------------------------------
        // ---- device modal globals
        const device = this.data.device;
        this.isCurrentAgreement = !!parseInt(this.data.agrHeader.agr_id);                               // -- jest aktualna umowa?
        this.$tbodyAgrCurrent = this.$body.find('table[data-name=table-agr-active] tbody');             // -- body tabelki aktualnej umowy
        // ---- tab6 dev Addresses
        this.$divDevAddresses = this.$body.find('div[data-id=devAddresses]');
        this.$instAddrStatus = this.$divDevAddresses.find('span[data-name=inst-addr-status]');
        this.$instAddrLegend = this.$divDevAddresses.find('legend[data-name=inst-addr-legend]');
        this.$tonerAddrStatus = this.$divDevAddresses.find('span[data-name=toner-addr-status]');
        this.$tonerAddrLegend = this.$divDevAddresses.find('legend[data-name=toner-addr-legend]');
        // ---- ------------------------------------------------------------------------
        // ---- tab2 counters
        this.$tableCounters = this.$body.find('table[data-name=table-counters');
        this.tableCountersInit = {
            ...dataTableInit,
            order: [[2, 'desc']],
            columns: [
                {'data': 'counter_service_code'},
                {'data': 'counter_value'},
                {'data': 'counter_date_issue'},
                {'data': 'counter_accepted_txt'},
                {'data': 'counter_is_settled_txt'},
                {'data': 'counter_archive_txt'},
                {'data': 'counter_source'},
                {'data': 'counter_employee_name'},
            ],
            columnDefs: [
                {
                    ...dataTableInit,
                    target: [2, 6, 7],
                    className: 'ellipsis',
                }
            ],
        }
        this.tableCounters = this.$tableCounters.DataTable(this.tableCountersInit);
        this.dataTablesList['tableCounters'] = this.tableCounters
        // ---- ------------------------------------------------------------------------
        // ---- tab3 work cards
        this.$tableWC = this.$body.find('table[data-name=table-work-cards');
        this.tableWCInit = {
            ...dataTableInit,
            order: [[4, 'desc']],
            rowId: 'wc_id',
            columns: [
                {'data': 'wc_no'},
                {'data': 'wc_technician_name'},
                {'data': 'wc_status_txt'},
                {'data': 'sh_register_date'},
                {'data': 'wc_last_modification_date'},
            ],
            columnDefs: [],
        }
        this.tableWC = this.$tableWC.DataTable(this.tableWCInit);
        this.dataTablesList['tableWC'] = this.tableWC
        this.$tableWC.on('click', 'tr', async (e) => {
            const modal = new MyModal('work-card', {'wc_id': +$(e.currentTarget).attr('id')}, this);
            await modal.initialize();
        })
        // ---- tab6 agr item rates
        this.$tableRates = this.$body.find('table[data-name=table-rates');
        this.tableRatesInit = {
            ...dataTableInit,
            order: [[0, 'asc']],
            searching: false,
            info: false,
            paging: false,
            autoWidth: false,
            rowId: 'rate_id',
            columns: [
                {'data': 'rate_lp'},
                {'data': 'rate_code'},
                {'data': 'rate_value'},
                {'data': 'rate_free_copies_in_cnu'},
                {'data': 'rate_is_lump_sum_txt'},
                {'data': 'rate_company_unit_txt'},
                {'data': 'rate_notes'},
                {'data': null},
            ],
            columnDefs: [
                {
                    ...dataTableColumnDef,
                    targets: [2],
                    type: 'num',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(4);
                        } else {
                            return cellData;
                        }
                    },
                },
                {
                    ...dataTableColumnDef,
                    targets: [-1],
                    orderable: false,
                    searching: false,
                    width: '4%',
                    type: 'html',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return '<button class="btn btn-sm btn-secondary py-0 px-1" type="button" data-name="update-rate"><i class="bi bi-pencil-square"></i></button>';
                        } else {
                            return cellData;
                        }
                    },
                },

            ],
        }
        this.tableRates = this.$tableRates.DataTable(this.tableRatesInit);
        this.dataTablesList['tableRates'] = this.tableRates
        // -----------------------------------------------------------------------------------
        // ==== dane statyczne - nie trzeba odświeżać po edycji ==============================
        // ---- modal title ----
        let headerTxt = '';
        headerTxt += '<span class="fs-7">\xa0\xa0\xa0\xa0\xa0urządzenie:\xa0\xa0</span>'
            + '<span class="fs-4">' + device.dev_model_name + '</span>';
        headerTxt += '<span class="fs-7">\xa0\xa0\xa0\xa0\xa0nr seryjny:\xa0\xa0</span>'
            + '<span class="fs-4">' + device.dev_serial_no + '</span>';
        this.$title.html(headerTxt);
        // ---- tab1 device model params bar ----
        this.$body.find('div[title=model-info] span').each(function () {
                const $this = $(this);
                const v = device[$this.attr('title')];
                if (v !== undefined) {
                    $this.text(v);
                }
            }
        );
        // ---- tab2 counters
        this.tableCounters.rows.add(this.data.counters).draw();
        // ---- tab3 work cards
        this.tableWC.rows.add(this.data.workCards).draw();
        // ---- jest aktualna umowa?
        let row = '';
        if (this.isCurrentAgreement) {
            // ---- update rate modals
            //console.log(`CUD`);
            //console.log(CUD.permissions);
            if (CUD.roles.includes('Super Admin') || CUD.permissions.includes('edit-device')) {
                this.$body.on('click', 'button[data-name=update-rate]', this.updateRateModalInit.bind(this));
            }
            // ---- agr header
            const agrHeader = this.data.agrHeader;
            this.$body.find('div[data-id=agrHeader] input[type=text]').each(function () {
                    const $this = $(this);
                    const v = agrHeader[$this.attr('name')];
                    if (v !== undefined) {
                        $this.val(v);
                    }
                }
            );
            row = '<tr id="' + agrHeader.agr_id + '">' +
                '<td>' + agrHeader.agr_no + '</td>' +
                '<td>' + agrHeader.agr_period + '</td>' +
                '<td>' + agrHeader.agr_purchaser_txt + '</td>' +
                '<td>' + agrHeader.agr_type_txt + '</td>' +
                '<td>' + agrHeader.agr_status_txt + '</td>' +
                '<td>' + device.ai_status_txt + '</td>' +
                '</tr>'
        } else {
            row = '<tr><td colspan="6" class="text-center">Brak aktywnej umowy</td></tr>';
            // ---- hide tabs related to current agreement
            this.$body.find('li[data-is-agreement=yes]').each((index, element) => {
                $(element).hide();
            })
        }
        // ---- tab1 current agreement
        this.$tbodyAgrCurrent.append(row);
        this.$tbodyAgrCurrent.on('click', 'tr', async (e) => {
            const modal = new MyModal('agreement', {'agr_id': +$(e.currentTarget).attr('id')}, this);
            await modal.initialize();
        })
        // ==================================================================================
        this.refreshModalContent();  // ---- resztę odświeżamy
        // ---- podpinamy możliwość update
        // console.log('CUD');
        // console.log(CUD);
        if (CUD.roles.includes('Super Admin') || CUD.permissions.includes('edit-device')) {
            this.$body.on('click', 'button[data-type=update]', this.updateModalInit.bind(this));
        }


    }

    nativeDocument = () => {
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
            rowId: 'ai_dev_id',
            paging: false,
            autoWidth: false,
            searching: true,
            info: false,
            order: [[0, 'asc']],
            columns: [
                {data: null},                              // --- 0
                {data: 'ai_art_name'},                     // --- 1
                {data: 'ai_dev_no'},                       // --- 2
                {data: 'ai_serial_no'},                    // --- 3
                {data: 'ai_status_txt'},                   // --- 4
                {data: 'ai_replacement_parts_kind_txt', visible: false},   // --- 5
                {data: 'ai_billing_if_no_counter_txt'},    // --- 6
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
        this.$tableAgrItems.on('click', 'tr', async (e) => {
            const id = parseInt($(e.currentTarget).attr('id'));
            const modal = new MyModal('device', {'dev_id': id}, this);
            await modal.initialize();
        })
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
            const modal = new MyModal('native-document', {'doc_id': id}, this);
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

    workCard = () => {
        console.log('work card content');
        console.log(this.data);
        const header = this.data.header;
        const agrCurrent = this.data.agrCurrent;
        const agrItem = this.data.agrItem;
        // -----------------------------------------------------------------------------
        // ---- modal title ----
        let headerTxt = '';
        headerTxt += '<span class="fs-7">\xa0\xa0\xa0\xa0\xa0zlecenie:\xa0\xa0</span>'
            + '<span class="fs-4">' + header.wc_no + '</span>';
        headerTxt += '<span class="fs-7">\xa0\xa0\xa0\xa0\xa0dla:\xa0\xa0</span>'
            + '<span class="fs-4">' + header.sh_cust_name + '</span>';
        this.$title.html(headerTxt);
        // -----------------------------------------------------------------------------
        this.$body.find('button[data-name=show-device]').on('click', async (e) => {
            const id = parseInt(this.data.header.dev_id);
            const modal = new MyModal('device', {'dev_id': id}, this);
            await modal.initialize();
        })
        // -----------------------------------------------------------------------------
        // ---- left panel tab 0,1,2  ----
        this.$body.find('input, textarea').each(
            function () {
                const $this = $(this);
                let v = header[$this.attr('name')];
                let x = agrCurrent[$this.attr('name')];
                let z = agrItem[$this.attr('name')];
                if (v !== undefined) {
                    $this.val(v);
                } else if (x !== undefined) {
                    $this.val(x);
                } else if (z !== undefined) {
                    if($this.attr('name') === 'ai_installation_address'){
                        if(+agrItem['ai_installation_address_status'] !== 1){
                            $this.css('color','red');
                        }
                    }
                    if($this.attr('name') === 'ai_toner_address'){
                        if(+agrItem['ai_toner_address_status'] !== 1){
                            $this.css('color','red');
                        }
                    }
                    $this.val(z);
                }
            }
        );
        // -----------------------------------------------------------------------------
        // ---- tab 3 actions
        this.$tableActions = this.$body.find('table[data-name=table-actions');
        this.tableActionsInit = {
            ...dataTableInit,
            order: [[1, 'asc']],
            searching: false,
            info: false,
            paging: false,
            autoWidth: false,
            rowId: 'wc_action_id',
            columns: [
                {'data': 'wc_action_txt'},
                {'data': 'wc_action_start_date'},
                {'data': 'wc_action_end_date'},
                {'data': 'wc_action_description'},
            ],
            columnDefs: [],
        }
        this.tableActions = this.$tableActions.DataTable(this.tableActionsInit);
        this.dataTablesList['tableActions'] = this.tableActions
        this.tableActions.clear();
        this.tableActions.rows.add(this.data.actions).draw();
        // -----------------------------------------------------------------------------
        // ---- tab 4 materias
        this.$tableMaterials = this.$body.find('table[data-name=table-materials');
        this.tableMaterialsInit = {
            ...dataTableInit,
            order: [[1, 'asc']],
            searching: false,
            info: false,
            paging: false,
            autoWidth: false,
            rowId: 'wcm_id',
            columns: [
                {'data': 'art_code'},
                {'data': 'art_name'},
                {'data': 'quantity_ordered'},
                {'data': 'quantity_realized'},
                {'data': 'quantity_used'},
                {'data': 'price'},
            ],
            columnDefs: [
                {
                    ...dataTableInit,
                    target: [0, 1],
                    className: 'ellipsis',
                },
                {
                    ...dataTableInit,
                    target: [2, 3, 4, 5],
                    type: 'num',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },

            ],
        }
        this.tableMaterials = this.$tableMaterials.DataTable(this.tableMaterialsInit);
        this.dataTablesList['tableMaterials'] = this.tableMaterials
        this.tableMaterials.clear();
        this.tableMaterials.rows.add(this.data.materials).draw();
        // -----------------------------------------------------------------------------
        // ---- tab 5 services
        this.$tableServices = this.$body.find('table[data-name=table-services');
        this.tableServicesInit = {
            ...dataTableInit,
            order: [[1, 'asc']],
            searching: false,
            info: false,
            paging: false,
            autoWidth: false,
            rowId: 'wcs_id',
            columns: [
                {'data': 'art_code'},
                {'data': 'art_name'},
                {'data': 'quantity'},
                {'data': 'price'},
            ],
            columnDefs: [
                {
                    ...dataTableInit,
                    target: [0, 1],
                    className: 'ellipsis',
                },
                {
                    ...dataTableInit,
                    target: [2, 3],
                    type: 'num',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },

            ],
        }
        this.tableServices = this.$tableServices.DataTable(this.tableServicesInit);
        this.dataTablesList['tableServices'] = this.tableServices
        this.tableServices.clear();
        this.tableServices.rows.add(this.data.services).draw();
        // -----------------------------------------------------------------------------
        // ---- tab 6 Documents
        this.$tableDocuments = this.$body.find('table[data-name=table-documents');
        this.tableDocumentsInit = {
            ...dataTableInit,
            order: [[1, 'asc']],
            searching: false,
            info: false,
            paging: false,
            autoWidth: false,
            rowId: 'doc_id',
            'createdRow': function (row, data, dataIndex) {
                $(row).addClass('pointer');
            },
            columns: [
                {'data': 'doc_no'},
                {'data': 'doc_date'},
                {'data': 'doc_purchaser_name'},
                {'data': 'doc_net_value'},
                {'data': 'doc_state_txt'},
            ],
            columnDefs: [
                {
                    ...dataTableInit,
                    target: [0, 2],
                    className: 'ellipsis',
                },
                {
                    ...dataTableInit,
                    target: [1],
                    type: 'string',
                },
                {
                    ...dataTableInit,
                    target: [3],
                    type: 'num',
                    render: function (cellData, type, rowData) {
                        if (type === 'display') {
                            return parseFloat(cellData).toFixed(2);
                        } else {
                            return cellData;
                        }
                    },
                },

            ],
        }
        this.tableDocuments = this.$tableDocuments.DataTable(this.tableDocumentsInit);
        this.dataTablesList['tableDocuments'] = this.tableDocuments
        this.tableDocuments.clear();
        this.tableDocuments.rows.add(this.data.documents).draw();
        this.$tableDocuments.on('click', 'tr', async (e) => {
            const modal = new MyModal('native-document', {'doc_id': +$(e.currentTarget).attr('id')}, this);
            await modal.initialize();
        })

    }

}

export {
    MyModal,
}
