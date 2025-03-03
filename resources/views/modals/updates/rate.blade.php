<div class="modal modal-type-1" tabindex="-1" data-bs-keyboard="false" id="my-modal-id" data-name="modal" aria-labelledby="modal-label" aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog modal-width-600">
        <!-- content -->
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header p-2">
                <div class="row">
                    <h5 class="modal-title"></h5>
                </div>
                <button type="button" class="btn-close btn-sm me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- end header -->
            <!-- body -->
            <div class="modal-body">
                <section data-name="filters">

                    <input type="hidden" name="rate_id" value="0">
                    <input type="hidden" name="rate_art_id" value="0">
                    <input type="hidden" name="rate_item_id" value="0">

{{--                    <div class="ai-params">--}}

{{--                        <div class="input-group input-group-sm mb-2">--}}
{{--                            <label class="input-group-text label-min-width-250 text-secondary-emphasis">Usługa dla odczytów ponad ryczałt</label>--}}
{{--                            <input type="text" class="form-control label-max-width-150 _text-end old" name="old_ai_extra_value_service_txt" disabled>--}}
{{--                            <select class="form-select _text-end" name="ai_extra_value_service_id">--}}
{{--                                <option value="0">--- nie wybrano ---</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="input-group input-group-sm mb-4">--}}
{{--                            <label class="input-group-text label-min-width-250 text-secondary-emphasis">Odliczaj wartości odczytów od ryczałtu</label>--}}
{{--                            <input type="text" class="form-control label-max-width-150 _text-end old" name="old_ai_extra_value_in_cnu_txt" disabled>--}}
{{--                            <select class="form-select _text-end" name="ai_extra_value_in_cnu">--}}
{{--                                <option value="0">nie</option>--}}
{{--                                <option value="1">tak</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                    </div>--}}


                    <div class="input-group input-group-sm mb-2">
                        <label class="input-group-text label-min-width-200 text-secondary-emphasis">Lp.</label>
                        <input type="text" class="form-control" name="rate_lp" disabled>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <label class="input-group-text label-min-width-200 text-secondary-emphasis">Kod usługi</label>
                        <input type="text" class="form-control" name="rate_code" disabled>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <label class="input-group-text label-min-width-200 text-secondary-emphasis">Cena</label>
                        <input type="text" class="form-control label-max-width-150 _text-end old" name="old_rate_value" disabled>
                        <input type="number" class="form-control text-end" name="rate_value" min="0" step="0.001">
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <label class="input-group-text label-min-width-200 text-secondary-emphasis">Liczba kopii w CNU</label>
                        <input type="text" class="form-control label-max-width-150 _text-end old" name="old_rate_free_copies_in_cnu" disabled>
                        <input type="number" class="form-control text-end" name="rate_free_copies_in_cnu" min="0" step="1">
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <label class="input-group-text label-min-width-200 text-secondary-emphasis">Odliczaj licznik od tej usługi</label>
                        <input type="text" class="form-control label-max-width-150 _text-end old" name="old_rate_is_lump_sum_txt" disabled>
                        <select class="form-select _text-end" name="rate_is_lump_sum" disabled>
                            <option value="0">nie</option>
                            <option value="1">tak</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <label class="input-group-text label-min-width-200 text-secondary-emphasis">Podlega centrum</label>
                        <input type="text" class="form-control label-max-width-150 _text-end old" name="old_rate_company_unit_txt" disabled>
                        <select class="form-select _text-end" name="rate_company_unit_id">
                            <option value="0" selected>--- nie wybrano ---</option>
                        </select>
                    </div>

                    <div class="form-floating _mb-3">
                        <textarea class="form-control old" style="height: 80px" name="old_rate_notes" spellcheck="false" disabled></textarea>
                        <label class="text-secondary-emphasis">Dane dodatkowe</label>
                    </div>

                    <div class="_form-floating _mb-3">
                        <textarea class="form-control" style="height: 80px" name="rate_notes" spellcheck="false"></textarea>
                    </div>


                </section>
            </div>
            <!-- end body -->
            <!-- footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-name="btn-save">Zapisz zmiany</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Zamknij</button>
            </div>
            <!-- end footer -->
        </div>
        <!-- end content -->
    </div>
    <!-- end dialog -->
</div>
