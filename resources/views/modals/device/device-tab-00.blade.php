{{--<div class="tab-pane fade show active" id="di-tab-1"><!-- tab-1 -->--}}
<div class="row" title="model-info">
    <div class="d-inline mt-2 fs-7">
        Typ:<strong class="p-2"><span class="fs-6" title="dev_type_txt"></span></strong>
        Rodzaj:<strong class="p-2"><span class="fs-6" title="dev_kind_txt"></span></strong>
        Format:<strong class="p-2"><span class="fs-6" title="dev_format_txt"></span></strong>
        Producent:<strong class="p-2"><span class="fs-6" title="dev_producer_txt"></span></strong>
        Princity ID:<strong class="p-2"><span class="fs-6" title="dev_princity_id"></span></strong>
    </div>
</div>

<div class="row">
    <div>
        <hr class="mt-2">
    </div>
</div>

<div class="row">

    <div class="col-8">
        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Kontrahent przypisany do urządzenia</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_cust_name" disabled/>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">NIP</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_cust_tin" disabled/>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-4">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Model</label>
            </div>
            <div class="row mb-2">
                <div class="input-group input-group-sm p-0 m-0">
                    <input type="text" class="form-control form-control-sm" name="dev_model_name" data-value-type="select" data-label="Model" disabled/>
                    <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="device"><i class="bi-pencil-square"></i></button>
                </div>
            </div>
        </div>

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Numer umowy leasingu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_leasing_agree_no" disabled/>
            </div>
        </div>

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Kod kartoteki urzędzenia używanego</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_used_article_code" disabled/>
            </div>
        </div>

    </div>

    <div class="col-4">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Numer urządzenia</label>
            </div>
            <div class="row mb-2">
                <div class="input-group input-group-sm p-0 m-0">
                    <input type="text" class="form-control form-control-sm" name="dev_no" data-value-type="text" data-label="Numer urządzenia" disabled/>
                    <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="device"><i class="bi-pencil-square"></i></button>
                </div>
            </div>
        </div>

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Data rozpoczęcia umowy leasingu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_leasing_agree_date_from" disabled/>
            </div>
        </div>

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Nazwa kartoteki urzędzenia używanego</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_used_article_name" disabled/>
            </div>
        </div>

    </div>

    <div class="col-4">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Numer seryjny</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_serial_no" disabled/>
            </div>
        </div>

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Data zakończenia umowy leasingu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_leasing_agree_date_to" disabled/>
            </div>
        </div>

    </div>

</div>

<div class="row">
    <div>
        <hr class="mt-2">
    </div>
</div>

<div class="row">
    <div class="col-3">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Data ostatniego przeglądu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_last_review_date" disabled/>
            </div>
        </div>

    </div>

    <div class="col-3">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Ilość dni od ostatniego przeglądu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_last_review_days_at" disabled/>
            </div>
        </div>

    </div>

    <div class="col-3">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Data następnego przeglądu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_last_review_next_date" disabled/>
            </div>
        </div>

    </div>

    <div class="col-3">

        <div class="mx-1">
            <div class="row">
                <label class="col-form-label">Aktywne zlecenie przeglądu</label>
            </div>
            <div class="row mb-2">
                <input type="text" class="form-control form-control-sm" name="dev_active_review_wc_no" disabled/>
            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <fieldset class="border rounded-2 border-1">
                <legend class="float-none w-auto px-3 fs-6 mb-0">Aktualna umowa</legend>
                <div class="table-responsive mt-0">
                    <table class="table table-striped table-sm table-hover" data-name="table-agr-active">
                        <thead>
                        <tr>
                            <th scope="col">Nr umowy</th>
                            <th scope="col">Okres obowiązywania</th>
                            <th scope="col">Kontrahent</th>
                            <th scope="col">Typ umowy</th>
                            <th scope="col">Status umowy</th>
                            <th scope="col">Status urządzenia</th>
                        </tr>
                        </thead>
                        <tbody class="fs-6"></tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>

{{--</div><!-- end tab-1 -->--}}

