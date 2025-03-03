@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-12">
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

                        <div class="mt-3 mb-2 row">
                            <a href="{{ route('columns.create') }}" class="btn btn-primary btn-sm">Add Column</a>
                        </div>


                        {{--                        <form action="{{ route('columns.store') }}" method="post">--}}
{{--                            @csrf--}}

{{--                            <div class="mt-3 mb-2 row">--}}
{{--                                <input type="submit" class="col-1 btn btn-sm btn-primary" value="Save Row">--}}
{{--                            </div>--}}

{{--                            <div class="mb-1 row">--}}
{{--                                <div class="input-group input-group-sm px-0">--}}

{{--                                    <input type="hidden" name="dynamic_table_id" id="dynamic_table_id" value="{{ $table->id }}">--}}

{{--                                    <input type="text" class="form-control @error('targets') is-invalid @enderror" placeholder="targets"--}}
{{--                                           aria-label="targets" name="targets" id="targets" value="{{ old('targets') }}">--}}
{{--                                    @if ($errors->has('targets'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('targets') }}</span>--}}
{{--                                    @endif--}}

{{--                                    <input type="text" class="form-control @error('data') is-invalid @enderror" placeholder="data"--}}
{{--                                           aria-label="data" name="data" id="data" value="{{ old('data') }}">--}}
{{--                                    @if ($errors->has('data'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('data') }}</span>--}}
{{--                                    @endif--}}

{{--                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="title"--}}
{{--                                           aria-label="title" name="title" id="title" value="{{ old('title') }}">--}}
{{--                                    @if ($errors->has('title'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('title') }}</span>--}}
{{--                                    @endif--}}

{{--                                    <input type="text" class="form-control @error('width') is-invalid @enderror" placeholder="width"--}}
{{--                                           aria-label="width" name="width" id="width" value="{{ old('width') }}">--}}
{{--                                    @if ($errors->has('width'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('width') }}</span>--}}
{{--                                    @endif--}}

{{--                                    <input type="text" class="form-control @error('class_name') is-invalid @enderror" placeholder="class_name"--}}
{{--                                           aria-label="class_name" name="class_name" id="class_name" value="{{ old('class_name') }}">--}}
{{--                                    @if ($errors->has('class_name'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('class_name') }}</span>--}}
{{--                                    @endif--}}


{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </form>--}}

                    </div>
                </div>
                {{--                </section>--}}
            </div>
        </div>
    </div>
@endsection
