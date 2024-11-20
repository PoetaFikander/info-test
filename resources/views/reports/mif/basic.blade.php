@extends('layouts.app')
{{--@dump($patrons)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <form name="filters">
                <input type="hidden" name="patron_altum_id" id="patron_altum_id" value="0">

                <div class="card-header">
                    <div class="row">
                        <div class="col-1">MIF&nbsp;&nbsp;&nbsp;</div>
                        <div class="col-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="report_type" id="report-type-department" value="department" checked>
                                <label class="form-check-label" for="report-type-department">Oddział</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="report_type" id="report-type-patron" value="patron">
                                <label class="form-check-label" for="report-type-patron">Opiekun</label>
                            </div>
                            {{--                            <div class="form-check form-check-inline">--}}
                            {{--                                <input class="form-check-input" type="radio" name="report_type" id="report-type-agreement" value="agreement">--}}
                            {{--                                <label class="form-check-label" for="report-type-agreement">Umowa</label>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-check form-check-inline">--}}
                            {{--                                <input class="form-check-input" type="radio" name="report_type" id="report-type-device" value="device">--}}
                            {{--                                <label class="form-check-label" for="report-type-device">Urządzenie</label>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col px-1">
                            <div class="input-group">
                                <label class="input-group-text" for="year">Rok</label>
                                <select class="form-select" name="year" id="year">
                                    <option value="0" selected>---&nbsp;dowolny&nbsp;---</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                                    @endforeach
                                </select>
                                <label class="input-group-text" for="month">Miesiąc</label>
                                <select class="form-select" name="month" id="month">
                                    <option value="0" selected>---&nbsp;dowolny&nbsp;---</option>
                                    @foreach($months as $month)
                                        <option value="{{ $month->id }}">{{ $month->name }}</option>
                                    @endforeach
                                </select>
                                <label class="input-group-text" for="department_id">Oddział</label>
                                <select class="form-select" name="department_id" id="department_id">
                                    <option value="0" selected>---&nbsp;wszystkie&nbsp;---</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <label class="input-group-text" for="patron_altum_id">Opiekun</label>
                                <select class="form-select" name="patron_altum_id" id="patron_altum_id">
                                    <option value="0" selected>---&nbsp;dowolny&nbsp;---</option>
{{--                                    @foreach($patrons as $patron)--}}
{{--                                        <option value="{{ $patron->id }}">{{ $patron->name.' '.$patron->surname }}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                                <button type="button" class="btn btn-outline-secondary" name="btn-search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col p-0">
                            <hr class="my-2">
                        </div>
                    </div>
                    <div class="row" data-name="container-table-mif-list">
                        <table class="table table-striped table-bordered" data-name="table-mif-list">
                            <thead>
                            <tr>
                                <th scope="col">Oddział</th>
                                <th scope="col">Ilość umów</th>
                                <th scope="col">Ilość urządzeń</th>
                                <th scope="col">A3 kolor</th>
                                <th scope="col">A3 mono</th>
                                <th scope="col">A4 kolor</th>
                                <th scope="col">A4 mono</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </form>
        </div>

    </div>

    {{--    @dump($years, $months, $departments)--}}

@endsection
@section('js')
    <script src="{{ asset('js/reports/reports.js') }}" type="module"></script>
@endsection
