<div class="modal modal-type-1" tabindex="-1" id="my-modal-id" data-name="modal" aria-labelledby="modal-label" aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog modal-xxl">
        <!-- content -->
        <div class="modal-content">
            <!-- header -->
            <div class="modal-header p-2">
                <div class="row">
                    <div class="modal-title">
                        <h4 class="doc_no me-4"></h4><h6 class="status"></h6>
                    </div>
                </div>
                <button type="button" class="btn-close me-4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- end header -->
            <!-- body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-3">

                            <div id="netValue">
                                <div class="row mb-2 align-items-center">
                                    <label class="col-6 col-form-label">Netto PLN</label>
                                    <div class="col-6 pe-0">
                                        <input type="text" class="form-control form-control-sm text-end" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div id="grossValue">
                                <div class="row mb-2 align-items-center">
                                    <label class="col-6 col-form-label">Brutto PLN</label>
                                    <div class="col-6 pe-0">
                                        <input type="text" class="form-control form-control-sm text-end" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div id="sourceNo">
                                <div class="row">
                                    <label class="col-form-label">Źródło</label>
                                </div>
                                <div class="row mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled/>
                                </div>
                            </div>

                            <div id="customer1">
                                <div class="row">
                                    <label class="col-form-label">Nabywca</label>
                                </div>
                                <div class="row mb-2">
                                    <textarea class="form-control form-control-sm h-content" rows="2" disabled></textarea>
                                </div>
                            </div>

                            <div id="customer2">
                                <div class="row">
                                    <label class="col-form-label">Odbiorca</label>
                                </div>
                                <div class="row mb-2">
                                    <textarea class="form-control form-control-sm h-content" rows="2" disabled></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div id="date1">
                                        <div class="row">
                                            <label class="col-form-label">Data wystawienia</label>
                                        </div>
                                        <div class="row">
                                            <input type="text" class="form-control form-control-sm" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div id="date2">
                                        <div class="row">
                                            <label class="col-form-label">Data aktywacji</label>
                                        </div>
                                        <div class="row" style="margin-left: -7px;">
                                            <input type="text" class="form-control form-control-sm" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6">
                                    <div id="date3">
                                        <div class="row">
                                            <label class="col-form-label">Data realizacji</label>
                                        </div>
                                        <div class="row">
                                            <input type="text" class="form-control form-control-sm" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="store1">
                                <div class="row">
                                    <label class="col-form-label">Magazyn</label>
                                </div>
                                <div class="row mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled/>
                                </div>
                            </div>

                            <div id="store2">
                                <div class="row">
                                    <label class="col-form-label">Magazyn</label>
                                </div>
                                <div class="row mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div id="paymentFormName">
                                        <div class="row">
                                            <label class="col-form-label">Płatność</label>
                                        </div>
                                        <div class="row">
                                            <input type="text" class="form-control form-control-sm" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div id="datePayment">
                                        <div class="row">
                                            <label class="col-form-label">Termin</label>
                                        </div>
                                        <div class="row mb-2" style="margin-left: -7px;">
                                            <input type="text" class="form-control form-control-sm" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="companyUnitName">
                                <div class="row">
                                    <label class="col-form-label">Właściciel</label>
                                </div>
                                <div class="row mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled/>
                                </div>
                            </div>

                            <div id="assistant">
                                <div class="row">
                                    <label class="col-form-label">Obsługujący</label>
                                </div>
                                <div class="row mb-2">
                                    <input type="text" class="form-control form-control-sm" disabled/>
                                </div>
                            </div>

                        </div>

                        <div class="col-9">

                            <fieldset class="border rounded-2 p-2 dt-justify-content-between-0">
                                <legend class="float-none w-auto px-3 fs-6 m-0">Zawartość dokumentu</legend>
                                <table class="table table-striped table-sm table-hover" data-name="table-doc-content">
                                    <thead>
                                    <tr>
                                        <th scope="col">Lp</th>
                                        <th scope="col">Kod</th>
                                        <th scope="col">Nazwa</th>
                                        <th scope="col">Ilość</th>
                                        <th scope="col">Cena</th>
                                        <th scope="col">Wartość</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-group-divider"></tbody>
                                </table>
                            </fieldset>

                            <hr class="my-2">

                            <fieldset class="border rounded-2 p-2">
                                <legend class="float-none w-auto px-3 fs-6 m-0">Opis dokumentu</legend>
                                <div id="description">
                                    <div class="row">
                                        <div class="col">
                                            <textarea class="form-control form-control-sm" rows="10" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        </div>

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
