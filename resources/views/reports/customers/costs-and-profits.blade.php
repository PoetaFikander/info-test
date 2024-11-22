@extends('layouts.app')
{{--@dump($customer)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <section data-name="filters">
                <input type="hidden" name="cust_id" value="{{ $customer->cust_id }}">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="d-inline-block">
                                <h7>kontrahent:&nbsp;&nbsp;</h7>
                            </div>
                            <div class="d-inline-block">
                                <h5>{{ $customer->cust_name }}</h5>
                            </div>
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
                                <button type="button" class="btn btn-secondary" name="profit-calculate-btn">
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
                                    @include('reports.customers.costs-and-profits-acc-item-01')
                                </div>
                                <div class="accordion-item">
                                    @include('reports.customers.costs-and-profits-acc-item-02')
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
