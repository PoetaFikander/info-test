@extends('layouts.app')
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <div class="card-header">Tabele dynamiczne</div>
            <div class="card-body">
                @can('create-dynamic-table')
                    <a href="{{ route('dynamic-tables.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Table</a>
                @endcan
                <table class="table table-striped table-bordered table-sm" data-name="table-dynamic-tables-list">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/it/it.js') }}" type="module"></script>
@endsection
