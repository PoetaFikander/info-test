@extends('layouts.app')

{{--@dump($section)--}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edytuj dział
                    </div>
                    <div class="float-end">
                        <a href="{{ route('sections.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('sections.update', $section->id) }}" method="post">
                        @csrf
                        @method("PUT")

                        <div class="mb-1 row">
                            <input type="submit" class="col-3 offset-5 btn btn-primary" value="Zapisz zmiany">
                        </div>

                        <div class="mb-1 row">
                            <label for="name" class="col-3 col-form-label text-end">Nazwa</label>
                            <div class="col-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                       value="{{ $section->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="description" class="col-3 col-form-label text-end">Opis</label>
                            <div class="col-8">
                                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                       value="{{ $section->description }}">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
