@extends('layouts.app')
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <div class="card-header">Działy</div>
            <div class="card-body">
                {{--                @can('create-user')--}}
                <a href="{{ route('sections.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>&nbsp;Dodaj nowy dział</a>
                {{--                @endcan--}}
                <table class="table table-striped table-bordered" data-name="table-sections-list">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Działania</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <th scope="row">{{ $section->id }}</th>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->description }}</td>
                            <td>
                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>&nbsp;Edycja</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
{{--@section('js')--}}
{{--    <script src="{{ asset('js/staff/employees.js') }}" type="module"></script>--}}
{{--@endsection--}}

{{--@dump($employees)--}}

