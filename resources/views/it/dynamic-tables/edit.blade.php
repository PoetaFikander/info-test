@extends('layouts.app')
{{--@dump($columns)--}}
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            {{--                <section data-name="filters">--}}

            <div class="card-header">
                <div class="float-start">
                    Edit Dynamic Table
                </div>
                <div class="float-end">
                    <a href="{{ route('dynamic-tables.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>

            <div class="card-body p-2">

                <div class="container">

                    <form action="{{ route('dynamic-tables.update', $table->id) }}" method="post">
                        @csrf
                        @method("PUT")

                        <div class="mt-3 mb-2 row">
                            <input type="submit" class="col-1 _offset-5 btn btn-sm btn-success" value="Update Table">
                        </div>

                        <div class="mb-1 row">
                            <div class="input-group input-group-sm px-0">
                                <span class="input-group-text">ID:{{ $table->id }}</span>

                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" aria-label="name"
                                       name="name" id="name" value="{{ $table->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif

                                <input type="text" class="form-control @error('data_name') is-invalid @enderror" placeholder="data name"
                                       aria-label="data_name" name="data_name" id="data_name" value="{{ $table->data_name }}">
                                @if ($errors->has('data_name'))
                                    <span class="text-danger">{{ $errors->first('data_name') }}</span>
                                @endif

                                <input type="text" class="form-control @error('view_path') is-invalid @enderror" placeholder="view path"
                                       aria-label="view_path" name="view_path" id="view_path" value="{{ $table->view_path }}">
                                @if ($errors->has('view_path'))
                                    <span class="text-danger">{{ $errors->first('view_path') }}</span>
                                @endif

                                <input type="text" class="form-control @error('view_name') is-invalid @enderror" placeholder="view name"
                                       aria-label="view_name" name="view_name" id="view_name" value="{{ $table->view_name }}">
                                @if ($errors->has('view_name'))
                                    <span class="text-danger">{{ $errors->first('view_name') }}</span>
                                @endif


                            </div>
                        </div>

                    </form>

                    <div class="row">
                        <div class="col p-0">
                            <hr class="my-2">
                        </div>
                    </div>

                    <div class="row">
                        <a href="{{ route('dynamic-tables.columns.create', $table->id) }}" class="col-1 btn btn-primary btn-sm">Add Column</a>
                    </div>

                    <div class="row">
                        <div class="col p-0">
                            <hr class="my-2">
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <table class="table table-sm" data-name="table-columns-list">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>tab ID</th>
                                <th>targets</th>
                                <th>data</th>
                                <th>title</th>
                                <th>width</th>
                                <th>class name</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="_table-group-divider">
                            @foreach($columns as $column)
                                <tr>
                                    <td style="max-width: 80px">
                                        <input type="text" class="form-control form-control-sm" name="id" value="{{ $column->id }}" disabled>
                                    </td>
                                    <td style="max-width: 80px">
                                        <input type="text" class="form-control form-control-sm" name="dynamic_table_id"
                                               value="{{ $column->dynamic_table_id }}" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="targets" value="{{ $column->targets }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="data" value="{{ $column->data }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="title" value="{{ $column->title }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="width" value="{{ $column->width }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="class_name" value="{{ $column->class_name }}">
                                    </td>
                                    <td class="save">
                                        <input type="button" class="btn btn-sm btn-primary" value="Save">
                                    </td>
                                    <td class="align-middle">
                                        <div class="message"></div>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            {{--                </section>--}}
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/it/it.js') }}" type="module"></script>
@endsection
