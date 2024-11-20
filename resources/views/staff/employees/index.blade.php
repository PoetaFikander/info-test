@extends('layouts.app')
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <div class="card-header">Pracownicy</div>
            <div class="card-body">
{{--                @can('create-user')--}}
                    <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>&nbsp;Dodaj nowego pracownika</a>
{{--                @endcan--}}
                <table class="table table-striped table-bordered" data-name="table-employees-list">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Oddział</th>
                        <th scope="col">Dział</th>
                        <th scope="col">Stanwisko</th>
                        <th scope="col">Działania</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/staff/employees.js') }}" type="module"></script>
@endsection

{{--@dump($employees)--}}

