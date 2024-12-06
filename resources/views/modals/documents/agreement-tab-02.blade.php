<div class="row mt-2">

    <fieldset class="border border-light rounded-2 p-2">
        <legend class="float-none w-auto px-3 fs-6 mb-0 text-warning-emphasis">Parametry serwisowe</legend>
        <!-- wiersz 1 -->
        <div class="row mx-1">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Status instalacji</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_installation_status_txt"
                               disabled/>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Sposób odczytu liczników</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_counters_check_type_txt"
                               disabled/>
                    </div>
                </div>
            </div>
            <!-- end kolumna 2 -->

            <!-- kolumna 3 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Kopie testowe</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_test_copy_amount"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_billing_if_no_counter_txt"
                               disabled/>
                    </div>
                </div>
            </div>
            <!-- end kolumna 4 -->


        </div>
        <!-- end wiersz 1 -->
    </fieldset>

    <fieldset class="border border-light rounded-2 p-2 mt-2">
        <legend class="float-none w-auto px-3 fs-6 mb-0 text-warning-emphasis">Parametry SLA</legend>
        <!-- wiersz 1 -->
        <div class="row mx-1">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Czas reakcji (ilość godzin)</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_reaction_time"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_repair_time"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_client_work_time"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_client_actual_work_time"
                               disabled/>
                    </div>
                </div>
            </div><!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
        <!-- wiersz 2-->
        <div class="row mx-1">
            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Rodzaj części zamiennych</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_replacement_parts_kind_txt"
                               disabled/>
                    </div>
                </div>
            </div>
            <!-- end kolumna 1 -->

            <!-- kolumna 2 -->
            <div class="col-3">
                <!--
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Obrót urządzenia (najem)</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="device_income"
                               disabled/>
                    </div>
                </div>
                -->
            </div>
            <!-- end kolumna 2 -->

        </div>
        <!-- end wiersz 2 -->
    </fieldset>

    <fieldset class="border border-light rounded-2 p-2 mt-2">
        <legend class="float-none w-auto px-3 fs-6 mb-0 text-warning-emphasis">Parametry gwarancji</legend>
        <!-- wiersz 1 -->
        <div class="row mx-1">
            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Data gwarancji DKS</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_guarantee_date_dks"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_guarantee_date_producent"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_print_amount"
                               disabled/>
                    </div>
                </div>
            </div><!-- end kolumna 3 -->

            <!-- kolumna 4 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Ilość miesiecy w cyklu</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_months_in_cycle"
                               disabled/>
                    </div>
                </div>
            </div><!-- end kolumna 4 -->

        </div>
        <!-- end wiersz 1 -->
        <!-- wiersz 2-->
        <div class="row mx-1">
            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Limit kopii gwarancyjnych</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_copy_limit"
                               disabled/>
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

    <fieldset class="border border-light rounded-2 p-2 mt-2">
        <legend class="float-none w-auto px-3 fs-6 mb-0 text-warning-emphasis">Osoby odpowiedzialne</legend>
        <!-- wiersz 1 -->
        <div class="row mx-1">

            <!-- kolumna 1 -->
            <div class="col-3">
                <div class="mx-1">
                    <div class="row">
                        <label class="col-form-label">Osoba odpowiedzialna DKS</label>
                    </div>
                    <div class="row mb-2">
                        <input type="text" class="form-control form-control-sm" name="agr_dks_person"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_dks_tech_person"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_client_person"
                               disabled/>
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
                        <input type="text" class="form-control form-control-sm" name="agr_client_person_toner"
                               disabled/>
                    </div>
                </div>
            </div>
            <!-- end kolumna 4 -->


        </div>
        <!-- end wiersz 1 -->
    </fieldset>

</div>
