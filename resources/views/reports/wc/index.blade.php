@extends('layouts.app')
{{--@dump($custFilterOptions)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <section data-name="filters">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <h5 class="mb-0">Lista zleceń serwisowych</h5>
                            <span class="fs-7">Raporty&nbsp;&nbsp;&raquo;&nbsp;&nbsp;Zlecenia serwisowe</span>
                        </div>
                        <div class="col-5" data-name="message"></div>
                        <div class="col-3" data-name="columns_title">

                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    Ukryj kolumny
                                </button>
                                <form class="dropdown-menu p-4" name="form-columns-title">
                                    <div class="mb-3" data-name="hide-column-inputs"></div>
                                    <div class="container text-center">
                                        <button type="button" class="btn btn-sm btn-secondary" name="btn-columns-config-save">Zapisz ustawienia</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Zlecenie</label>
                                <input type="search" class="form-control" name="wc_no" value="" placeholder="wpisz fragment numeru">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Technik</label>
                                {{--multiple="multiple"--}}
                                <select class="form-select" name="wc_technician_ids">
                                    <option value="0" selected>--- nie wybrano ---</option>
                                    @foreach($technicians as $technician)
                                        <option value="{{ $technician->technician_id }}">{{ $technician->employee_name_surname }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Status</label>
                                <select class="form-select" name="wc_status_ids">
                                    <option value="0" selected>--- nie wybrano ---</option>
                                    @foreach($wcStatuses as $wcStatus)
                                        <option value="{{ $wcStatus->value_id }}">{{ $wcStatus->value_txt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Centrum</label>
                                <select class="form-select" name="sh_company_unit_ids">
                                    <option value="0" selected>--- nie wybrano ---</option>
                                    @foreach($companyUnits as $companyUnit)
                                        <option value="{{ $companyUnit->unit_id }}">{{ $companyUnit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row align-items-center mt-2">

                        <div class="col-6">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Kontrahent</label>
                                <input type="search" class="form-control" name="sh_cust_name" value="" placeholder="wpisz fragment nazwy kontrahenta">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Nazwa urz.</label>
                                <input type="search" class="form-control" name="dev_name" value="" placeholder="wpisz fragment nazwy urzadzenia">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Nr seryjny</label>
                                <input type="search" class="form-control" name="dev_serial_no" value="" placeholder="wpisz pełny numer seryjny">
                            </div>
                        </div>

                    </div>

                    <div class="row align-items-center _justify-content-center _text-center mt-2">

                        <div class="col-4">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text">Data od: </label>
                                <input type="date" class="form-control" name="date_from" value="{{ $date_from }}">
                                <label class="input-group-text"> do: </label>
                                <input type="date" class="form-control" name="date_to" value="{{ $date_to }}">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="input-group input-group-sm justify-content-center">
                                <button type="button" class="btn btn-secondary" name="btn-search"><i class="bi bi-search"></i>&nbsp;Szukaj</button>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="input-group input-group-sm">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="wcOpened" id="wcOpened" checked>
                                    <label class="form-check-label form-check-label-sm" for="wcOpened">Zlecenia otwarte</label>
                                </div>
                                <div class="form-check form-check-inline ms-3">
                                    <input class="form-check-input" type="checkbox" name="wcClosed" id="wcClosed">
                                    <label class="form-check-label form-check-label-sm" for="wcClosed">Zlecenia zamknięte</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col p-0">
                            <hr class="my-2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table class="table table-striped table-bordered table-hover table-vvsm pointer" data-name="table-wc-list">
                                <thead><tr></tr></thead>
                                <tbody class="table-group-divider"></tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </section>
        </div>

    </div>

@endsection
@section('js')
    <script src="{{ asset('js/reports/reports.js') }}" type="module"></script>
@endsection
