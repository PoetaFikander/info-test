<div class="row">

    <fieldset class="border rounded-2 border-1 mt-1">
        <legend class="float-none w-auto px-3 fs-6">Szczegóły</legend>
        <!-- wiersz 1 -->
        <div class="row">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Oddział obsługujący</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_service_company_unit_txt" data-value-type="select"
                                   data-label="Oddział obsługujący" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Odliczaj wartości odczytów od ryczałtu</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_extra_value_in_cnu_txt" disabled/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 2 -->

            <!-- kolumna 3 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Usługa dla odczytów ponad ryczałt</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_extra_value_service_txt"  disabled/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 3 -->

            <!-- kolumna 4 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Fakturowanie gdy brak licznika</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_billing_if_no_counter_txt" data-value-type="select"
                                   data-label="Fakturowanie gdy brak licznika" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
    </fieldset>


    <fieldset class="border rounded-2 border-1 mt-2">
        <legend class="float-none w-auto px-3 fs-6">Parametry serwisowe</legend>
        <!-- wiersz 1 -->
        <div class="row">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Status instalacji</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_installation_status_txt" data-value-type="select"
                                   data-label="Status instalacji" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Data deinstalacji urządzenia</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_uninstall_date" data-value-type="date" data-label="Data deinstalacji urządzenia" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 2 -->

            <!-- kolumna 3 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Sposób odczytu liczników</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_counters_check_type_txt" data-value-type="select"
                                   data-label="Sposób odczytu liczników" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 3 -->

            <!-- kolumna 4 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Kopie testowe</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_test_copy_amount" data-value-type="text"
                                   data-label="Kopie testowe" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
    </fieldset>

    <fieldset class="border rounded-2 border-1 mt-2">
        <legend class="float-none w-auto px-3 fs-6">Parametry SLA</legend>
        <!-- wiersz 1 -->
        <div class="row">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Czas reakcji (ilość godzin)</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_reaction_time" data-value-type="text"
                                   data-label="Czas reakcji (ilość godzin)" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Czas naprawy (ilość godzin)</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_repair_time" data-value-type="text"
                                   data-label="Czas naprawy (ilość godzin)" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end kolumna 2 -->

            <!-- kolumna 3 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Godziny pracy klienta</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_client_work_time" data-value-type="text"
                                   data-label="Godziny pracy klienta" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- end kolumna 3 -->

            <!-- kolumna 4 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Faktyczny czas pracy klienta</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_client_actual_work_time" data-value-type="text"
                                   data-label="Faktyczny czas pracy klienta" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
        <!-- wiersz 2-->
        <div class="row">
            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Rodzaj części zamiennych</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_replacement_parts_kind_txt" data-value-type="select"
                                   data-label="Rodzaj części zamiennych" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">

                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Obrót urządzenia (najem)</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_income" data-value-type="text"
                                   data-label="Obrót urządzenia (najem)" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end kolumna 2 -->

        </div>
        <!-- end wiersz 2 -->
    </fieldset>

    <fieldset class="border rounded-2 border-1 mt-2">
        <legend class="float-none w-auto px-3 fs-6">Parametry gwarancji</legend>
        <!-- wiersz 1 -->
        <div class="row">
            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Data gwarancji DKS</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_guarantee_date_dks" data-value-type="date"
                                   data-label="Data gwarancji DKS" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Data gwarancji producenta</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_guarantee_date_producer" data-value-type="date"
                                   data-label="Data gwarancji producenta" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 2 -->

            <!-- kolumna 3 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Ilość wydruków</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_print_amount" data-value-type="text"
                                   data-label="Ilość wydruków" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- end kolumna 3 -->

            <!-- kolumna 4 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Ilość miesięcy w cyklu</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_months_in_cycle" data-value-type="text"
                                   data-label="Ilość miesięcy w cyklu" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
        <!-- wiersz 2-->
        <div class="row">
            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Limit kopii gwarancyjnych</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_copy_limit" data-value-type="text"
                                   data-label="Limit kopii gwarancyjnych" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
            </div>
            <!-- end kolumna 2 -->

        </div>
        <!-- end wiersz 2 -->
    </fieldset>

    <fieldset class="border rounded-2 border-1">
        <legend class="float-none w-auto px-3 fs-6">Osoby odpowiedzialne</legend>
        <!-- wiersz 1 -->
        <div class="row">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Osoba odpowiedzialna DKS</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_dks_person_txt" data-value-type="select"
                                   data-label="Osoba odpowiedzialna DKS" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Technik</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_dks_tech_person_txt" data-value-type="select"
                                   data-label="Technik" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 2 -->

            <!-- kolumna 3 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Osoba odpowiedzialna Klient</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_client_person_txt" data-value-type="select"
                                   data-label="Osoba odpowiedzialna Klient" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 3 -->

            <!-- kolumna 4 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Osoba odpowiedzialna za odbiór</label>
                    </div>
                    <div class="row mb-2">
                        <div class="input-group input-group-sm p-0 m-0">
                            <input type="text" class="form-control form-control-sm" name="ai_client_person_pickup_txt" data-value-type="select"
                                   data-label="Osoba odpowiedzialna za odbiór" disabled/>
                            <button class="btn btn-sm btn-secondary" type="button" data-type="update" data-name="ai"><i class="bi-pencil-square"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
    </fieldset>

</div>
