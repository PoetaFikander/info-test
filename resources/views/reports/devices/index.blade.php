@extends('layouts.app')
{{--@dump($custFilterOptions)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <section data-name="filters">
{{--                <input type="hidden" name="code" value="">--}}
{{--                <input type="hidden" name="name" value="">--}}
{{--                <input type="hidden" name="tin" value="">--}}

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <h5 class="mb-0">Lista urządzeń</h5>
                            <span class="fs-7">Raporty&nbsp;&nbsp;&raquo;&nbsp;&nbsp;Urządzenia</span>
                        </div>
                        <div class="col-8" data-name="message"></div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row align-items-center">
                        <div class="col">
                            <div class="input-group">
                                <label class="input-group-text">Filtr</label>
                                <select class="form-select" name="filter_type">
                                    @foreach($devFilterOptions as $key => $value)
                                        <option value="{{ $key }}" @if($key === 'agr_no') selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
{{--                                UM/006131/2020  74634799067V0  A4FJ021001672 UM/000003/2025--}}
                                <input type="text" class="form-control w-75" name="filter_value" value="UM/006131/2020">
                                <button type="button" class="btn btn-secondary" name="btn-search"><i class="bi bi-search"></i></button>
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
                            <table class="table table-striped table-bordered table-hover" data-name="table-devices-list">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nr seryjny</th>
                                    <th scope="col">Nr urządzenia</th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">Umowa</th>
                                    <th scope="col">Kontrahent</th>
                                    <th scope="col">Działania</th>
                                </tr>
                                </thead>
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
