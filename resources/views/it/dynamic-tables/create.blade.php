@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Add New Table
                    </div>
                    <div class="float-end">
                        <a href="{{ route('dynamic-tables.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('dynamic-tables.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                       value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-end text-start">DataName</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('data_name') is-invalid @enderror" id="data_name" name="data_name"
                                       value="{{ old('data_name') }}">
                                @if ($errors->has('data_name'))
                                    <span class="text-danger">{{ $errors->first('data_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="phone" class="col-md-4 col-form-label text-md-end text-start">View path</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('view_path') is-invalid @enderror" id="view_path" name="view_path"
                                       value="{{ old('view_path') }}">
                                @if ($errors->has('view_path'))
                                    <span class="text-danger">{{ $errors->first('view_path') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="phone" class="col-md-4 col-form-label text-md-end text-start">View name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('view_name') is-invalid @enderror" id="view_name" name="view_name"
                                       value="{{ old('view_name') }}">
                                @if ($errors->has('view_name'))
                                    <span class="text-danger">{{ $errors->first('view_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Table">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
