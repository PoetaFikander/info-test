@extends('layouts.app')
{{--@dump($dynamic_table_id)--}}
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Add New Table Column
                    </div>
                    <div class="float-end">
                        <a href="{{ route('dynamic-tables.edit', $dynamic_table_id) }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('dynamic-tables.columns.store') }}" method="post">
                        @csrf

                        <div class="mt-3 mb-2 row">
                            <input type="submit" class="col-1 btn btn-sm btn-primary" value="Save Column">
                        </div>

                        <div class="mb-1 row">
                            <div class="input-group input-group-sm px-0">

                                <input type="hidden" name="dynamic_table_id" id="dynamic_table_id" value="{{ $dynamic_table_id }}">

                                <input type="text" class="form-control @error('targets') is-invalid @enderror" placeholder="targets"
                                       aria-label="targets" name="targets" id="targets" value="{{ old('targets') }}">
                                @if ($errors->has('targets'))
                                    <span class="text-danger">{{ $errors->first('targets') }}</span>
                                @endif

                                <input type="text" class="form-control @error('data') is-invalid @enderror" placeholder="data"
                                       aria-label="data" name="data" id="data" value="{{ old('data') }}">
                                @if ($errors->has('data'))
                                    <span class="text-danger">{{ $errors->first('data') }}</span>
                                @endif

                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="title"
                                       aria-label="title" name="title" id="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif

                                <input type="text" class="form-control @error('width') is-invalid @enderror" placeholder="width"
                                       aria-label="width" name="width" id="width" value="{{ old('width') }}">
                                @if ($errors->has('width'))
                                    <span class="text-danger">{{ $errors->first('width') }}</span>
                                @endif

                                <input type="text" class="form-control @error('class_name') is-invalid @enderror" placeholder="class_name"
                                       aria-label="class_name" name="class_name" id="class_name" value="{{ old('class_name') }}">
                                @if ($errors->has('class_name'))
                                    <span class="text-danger">{{ $errors->first('class_name') }}</span>
                                @endif

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
