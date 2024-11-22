@extends('layouts.app')
{{--@dump($custFilterOptions)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <section data-name="filters">
                <input type="hidden" name="code" value="">
                <input type="hidden" name="name" value="">
                <input type="hidden" name="tin" value="">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <h5 class="mb-0">Lista kontrahentów</h5>
                            <span class="fs-7">Raporty&nbsp;&nbsp;&raquo;&nbsp;&nbsp;Kontrahenci</span>
                        </div>
                        <div class="col-8" data-name="message"></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="input-group">
                                <label class="input-group-text" for="filter">Filtr</label>
                                <select class="form-select" name="filter_type">
                                    @foreach($custFilterOptions as $key => $value)
                                        <option value="{{ $key }}"
                                                @if($key === 'name') selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control w-75" name="filter_value" value="scania">
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
                            <table class="table table-striped table-bordered" data-name="table-customers-list">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Kod</th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Miejscowość</th>
                                    <th scope="col">Działania</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
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
