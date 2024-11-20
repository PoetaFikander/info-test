@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" data-name="container-main">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Dodaj nowego pracownika
                    </div>
                    <div class="float-end">
                        <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                {{--  card body --}}
                <div class="card-body">

                    <div class="container-fluid _p-0">

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="altum_id" class="input-group-text">Pracownicy w Altum</label>
                                    <select class="form-select" name="altum_id" id="altum_id">
                                        <option value="0">--- Nie wybrano ---</option>
                                        @foreach ($altumEmployees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name_surname }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-success" name="btn-select-altum-employee">
                                        <i class="bi bi-person-add">&nbsp;Wybierz</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr class="my-2">
                            </div>
                        </div>
                        <form action="{{ route('employees.store') }}" method="post" name="form-employee">
                            @csrf

                            <input type="hidden" id="is_active" name="is_active" value="0">
                            <input type="hidden" id="altum_id" name="altum_id" value="0">
                            <input type="hidden" id="salary_basis_net" name="salary_basis_net" value="0">

                            <div class="row mb-2">
                                <div class="col">

                                    <div class="mb-1 row">
                                        <label for="code" class="col-3 col-form-label text-end">Akronim</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="">
                                            @if ($errors->has('code'))
                                                <span class="text-danger">{{ $errors->first('code') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="name" class="col-3 col-form-label text-end">Imię</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="surname" class="col-3 col-form-label text-end">Nazwisko</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname"
                                                   value="">
                                            @if ($errors->has('surname'))
                                                <span class="text-danger">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="phone" class="col-3 col-form-label text-end">Telefon</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                                   value="">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="email" class="col-3 col-form-label text-end">E-mail</label>
                                        <div class="col-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                   value="">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="department_id" class="col-3 col-form-label text-end">Oddział</label>
                                        <div class="col-9">
                                            <select class="form-select" name="department_id" id="department_id">
                                                <option value="0" selected>--- Nie wybrano ---</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="section_id" class="col-3 col-form-label text-end">Dział</label>
                                        <div class="col-9">
                                            <select class="form-select" name="section_id" id="section_id">
                                                <option value="0" selected>--- Nie wybrano ---</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">
                                                        {{ $section->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="workplace_id" class="col-3 col-form-label text-end">Stanowisko</label>
                                        <div class="col-9">
                                            <select class="form-select" name="workplace_id" id="workplace_id">
                                                <option value="0" selected>--- Nie wybrano ---</option>
                                                @foreach ($workplaces as $workplace)
                                                    <option value="{{ $workplace->id }}">
                                                        {{ $workplace->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-3 text-end">
                                            <label for="salary_basis_gross" class="col-form-label">Wynagrodzenie brutto</label>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" id="salary_basis_gross" name="salary_basis_gross" value="0" min="0"
                                                   max="100000" step="1">
                                        </div>
                                        <div class="col-2 text-end">
                                            <label for="salary_basis_valid_from" class="col-form-label">Obowiązuje od</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control text-center" id="salary_basis_valid_from"
                                                   name="salary_basis_valid_from">
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <input type="submit" class="col-3 offset-5 btn btn-primary" value="Dodaj pracownika">
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>

                </div>
                {{--  end card body --}}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/staff/employees.js') }}" type="module"></script>
@endsection
