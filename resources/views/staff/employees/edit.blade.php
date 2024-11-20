@extends('layouts.app')

{{--@dump($employee, $workplaces)--}}

@section('content')
    <div class="row justify-content-center" data-name="container-main">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edytuj pracownika
                    </div>
                    <div class="float-end">
                        <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                {{--  card body --}}
                <div class="card-body">

                    <div class="container-fluid _p-0">

                        <form action="{{ route('employees.update', $employee->id) }}" method="post" name="form-employee">
                            @csrf
                            @method("PUT")

                            <input type="hidden" id="is_active" name="is_active" value="{{ $employee->is_active }}">
                            <input type="hidden" id="altum_id" name="altum_id" value="{{ $employee->altum_id }}">
                            <input type="hidden" id="salary_basis_net" name="salary_basis_net" value="{{ $employee->salary_basis_net }}">

                            <div class="row mb-2">
                                <div class="col">

                                    <div class="mb-1 row">
                                        <label for="code" class="col-3 col-form-label text-end">Akronim</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ $employee->code }}">
                                            @if ($errors->has('code'))
                                                <span class="text-danger">{{ $errors->first('code') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="name" class="col-3 col-form-label text-end">Imię</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $employee->name }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="surname" class="col-3 col-form-label text-end">Nazwisko</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname"
                                                   value="{{ $employee->surname }}">
                                            @if ($errors->has('surname'))
                                                <span class="text-danger">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="phone" class="col-3 col-form-label text-end">Telefon</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                                   value="{{ $employee->phone }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="email" class="col-3 col-form-label text-end">E-mail</label>
                                        <div class="col-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                   value="{{ $employee->email }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-1 row">
                                        <label for="department_id" class="col-3 col-form-label text-end">Oddział</label>
                                        <div class="col-9">
                                            <select class="form-select" name="department_id" id="department_id">
                                                <option value="0">--- Nie wybrano ---</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}" {{ ((int)$department->id === (int)$employee->department_id) ? 'selected' : '' }}>
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
                                                <option value="0">--- Nie wybrano ---</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}" {{ ((int)$section->id === (int)$employee->section_id) ? 'selected' : '' }}>
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
                                                <option value="0">--- Nie wybrano ---</option>
                                                @foreach ($workplaces as $workplace)
                                                    <option value="{{ $workplace->id }}" {{ ((int)$workplace->id === (int)$employee->workplace_id) ? 'selected' : '' }}>
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
                                            <input type="number" class="form-control" id="salary_basis_gross" name="salary_basis_gross" min="0"
                                                   max="100000" step="1" value="{{ $employee->salary_basis_gross }}">
                                        </div>
                                        <div class="col-2 text-end">
                                            <label for="salary_basis_valid_from" class="col-form-label">Obowiązuje od</label>
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control text-center" id="salary_basis_valid_from"
                                                   name="salary_basis_valid_from" value="{{ $employee->salary_basis_valid_from }}">
                                        </div>
                                    </div>


                                    <div class="mb-1 row">
                                        <input type="submit" class="col-3 offset-5 btn btn-primary" value="Zapisz zmiany">
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
{{--@section('js')--}}
{{--    <script src="{{ asset('js/staff/employees.js') }}" type="module"></script>--}}
{{--@endsection--}}
