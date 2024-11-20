@extends('layouts.app')

{{--@dump($salaries)--}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Dane pracownika
                    </div>
                    <div class="float-end">
                        <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row mb-1">
                        <label for="name" class="col-3 col-form-label text-end"><strong>{{ __('Name') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">{{ $employee->name }}</div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="surname" class="col-3 col-form-label text-end"><strong>{{ __('Surname') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">{{ $employee->surname }}</div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="phone" class="col-3 col-form-label text-end"><strong>{{ __('Phone') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">&nbsp;{{ $employee->phone }}</div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="email" class="col-3 col-form-label text-end"><strong>{{ __('Email') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">{{ $employee->email }}</div>
                        </div>
                    </div>


                    <div class="row mb-1">
                        <label for="department" class="col-3 col-form-label text-end"><strong>{{ __('Department') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">
                                {{ $employee->department->name }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="section" class="col-3 col-form-label text-end"><strong>{{ __('Section') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">
                                {{ $employee->section->name }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="workplace" class="col-3 col-form-label text-end"><strong>{{ __('Workplace') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">
                                {{ $employee->workplace->name }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="salary" class="col-3 col-form-label text-end"><strong>{{ __('Salary gross') }}</strong></label>
                        <div class="col-9">
                            <div class="form-control">
                                {{ $employee->salary_basis_gross }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="salaries" class="col-3 col-form-label text-end"><strong>{{ __('Salaries archive') }}</strong></label>
                        <div class="col-9">
                            <select class="form-select" id="salaries" name="salaries" multiple disabled>
                                @foreach ($salaries as $salary)
                                    <option>{{ 'podstawa brutto: '.$salary->basis_gross }}&nbsp;&nbsp;&nbsp;&nbsp;{{ 'ważna od: '.$salary->basis_valid_from }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
