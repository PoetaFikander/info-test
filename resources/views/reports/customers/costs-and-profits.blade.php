@extends('layouts.app')
{{--@dump($agreements)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <section data-name="filters">
                <input type="hidden" name="cust_id" value="{{ $customer->cust_id }}">

                <div class="card-header">

                    <div class="row align-items-center">
                        <div class="col">
                            <div class="d-inline-block">
                                <h7>kontrahent:&nbsp;&nbsp;</h7>
                            </div>
                            <div class="d-inline-block">
                                <h5>{{ $customer->cust_name }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table class="table table-sm table-hover table-vsm mb-1"  data-name="active-agreements">
                                <thead>
                                <tr>
                                    <th scope="col">Umowa</th>
                                    <th scope="col">Okres obowiązywania</th>
                                    <th scope="col">Oddział</th>
                                    <th scope="col">Opiekun</th>
                                    <th scope="col">Typ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($agreements as $agreement)
                                    <tr data-id="{{ $agreement->agr_id }}">
                                        <td class="pointer">{{ $agreement->agr_no }}</td>
                                        <td>{{ $agreement->agr_period }}</td>
                                        <td>{{ $agreement->agr_departament_txt }}</td>
                                        <td>{{ $agreement->agr_employee_txt }}</td>
                                        <td>{{ $agreement->agr_type_txt }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="input-group">
                                <label class="input-group-text">Okres od:</label>
                                <input type="date" class="form-control" name="date_from" value="{{ $dateFrom }}">
                                <label class="input-group-text">do:</label>
                                <input type="date" class="form-control" name="date_to" value="{{ $dateTo }}">
                                <label class="input-group-text" for="department_id">oddział</label>
                                <select class="form-select" name="department_id" id="department_id">
                                    <option value="0" selected>---&nbsp;wszystkie&nbsp;---</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-secondary" name="btn-search">
                                    <i class="bi bi-search"></i>&nbsp;Szukaj
                                </button>
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

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    @include('reports.customers.costs-and-profits-acc-item-00')
                                </div>
                                <div class="accordion-item">
                                    @include('reports.customers.costs-and-profits-acc-item-01')
                                </div>
                                <div class="accordion-item">
                                    @include('reports.customers.costs-and-profits-acc-item-02')
                                </div>
                                <div class="accordion-item">
                                    @include('reports.customers.costs-and-profits-acc-item-03')
                                </div>
                            </div>

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
