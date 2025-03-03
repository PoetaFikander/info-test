<div class="modal modal-type-1" tabindex="-1" id="my-modal-id" data-name="modal" aria-labelledby="modal-label" aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog modal-xxl">
        <!-- content -->
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header p-2">
                <div class="row">
                    <div class="modal-title">
                        <h4 class="me-4 agr_no"></h4><h6 class="status"></h6>
                    </div>
                </div>
                <button type="button" class="btn-close me-4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- end header -->
            <!-- body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row">
                        <!-- parametry nagłówka -->
                        <div class="col-3">
                            {{-- wc_status_txt --}}
                            <div class="row">
                                <label class="col-form-label">Status</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_status_txt" disabled/>
                            </div>
                            {{-- dev_name --}}
                            <div class="row">
                                <label class="col-form-label">Nazwa urządzenia</label>
                            </div>
                            <div class="row mb-2">
                                <div class="input-group input-group-sm p-0 m-0">
                                    <input type="text" class="form-control form-control-sm" name="dev_name" disabled/>
                                    <button class="btn btn-sm btn-secondary" type="button" data-name="show-device"><i class="bi-printer"></i></button>
                                </div>
                            </div>
                            {{-- dev_no --}}
                            <div class="row">
                                <label class="col-form-label">Nr urządzenia</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="dev_no" disabled/>
                            </div>
                            {{-- dev_serial_no --}}
                            <div class="row">
                                <label class="col-form-label">Nr seryjny urządzenia</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="dev_serial_no" disabled/>
                            </div>
                            {{-- sh_register_date --}}
                            <div class="row">
                                <label class="col-form-label">Data rejestracji zgłoszenia</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="sh_register_date" disabled/>
                            </div>
                            {{-- wc_last_modification_date --}}
                            <div class="row">
                                <label class="col-form-label">Data ostatniej modyfikacji zlecenia</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_last_modification_date" disabled/>
                            </div>
                            {{-- wc_technician_txt --}}
                            <div class="row">
                                <label class="col-form-label">Asystentka / Technik</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_technician_txt" disabled/>
                            </div>
                            {{-- wc_fault_type_txt --}}
                            <div class="row">
                                <label class="col-form-label">Rodzaj usterki</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_fault_type_txt" disabled/>
                            </div>
                            {{-- wc_priority_txt --}}
                            <div class="row">
                                <label class="col-form-label">Priorytet</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_priority_txt" disabled/>
                            </div>
                            {{-- wc_type_txt --}}
                            <div class="row">
                                <label class="col-form-label">Forma rozliczenia</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_type_txt" disabled/>
                            </div>
                            {{-- wc_planned_realization_term --}}
                            <div class="row">
                                <label class="col-form-label">Planowana data realizacji</label>
                            </div>
                            <div class="row mb-2">
                                <input type="text" class="form-control form-control-sm" name="wc_planned_realization_term" disabled/>
                            </div>
                        </div>
                        <!-- end parametry nagłówka -->

                        <!-- tabs -->
                        <div class="col-9" data-name="tabs" id="tabs">
                            <!-- nav-tab -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#descriptions" class="nav-link active" data-bs-toggle="tab">Adresy i opisy</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#request" class="nav-link" data-bs-toggle="tab">Zgłoszenie</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#parameters" class="nav-link" data-bs-toggle="tab">Parametry</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#activity-log" class="nav-link" data-bs-toggle="tab">Rejestr czynności</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#materials" class="nav-link" data-bs-toggle="tab">Materiały</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#services" class="nav-link" data-bs-toggle="tab">Usługi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#documents" class="nav-link" data-bs-toggle="tab">Dokumenty</a>
                                </li>
                            </ul>
                            <!-- end nav-tab -->
                            <!-- tab-content -->
                            <div class="tab-content mx-3 mt-2">
                                <div class="tab-pane fade show active" id="descriptions">
                                    @include('modals.documents.work-card-tab-00')
                                </div>
                                <div class="tab-pane fade" id="request">
                                    @include('modals.documents.work-card-tab-01')
                                </div>
                                <div class="tab-pane fade" id="parameters">
                                    @include('modals.documents.work-card-tab-02')
                                </div>
                                <div class="tab-pane fade" id="activity-log">
                                    @include('modals.documents.work-card-tab-03')
                                </div>
                                <div class="tab-pane fade" id="materials">
                                    @include('modals.documents.work-card-tab-04')
                                </div>
                                <div class="tab-pane fade" id="services">
                                    @include('modals.documents.work-card-tab-05')
                                </div>
                                <div class="tab-pane fade" id="documents">
                                    @include('modals.documents.work-card-tab-06')
                                </div>
                            </div>
                            <!-- end tab-content -->
                        </div>
                        <!-- end tabs -->
                    </div>
                </div>
            </div>
            <!-- end body -->
            <!-- footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
            <!-- end footer -->
        </div>
        <!-- end content -->
    </div>
    <!-- end dialog -->
</div>
