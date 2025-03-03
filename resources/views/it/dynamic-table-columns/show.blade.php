@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Table Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('dynamic-tables.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">


{{--                    <div class="row mb-1">--}}
{{--                        <label for="name" class="col-2 col-form-label text-end"><strong>{{ __('Name') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">{{ $user->name }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="surname" class="col-2 col-form-label text-end"><strong>{{ __('Surname') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">{{ $user->surname }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="phone" class="col-2 col-form-label text-end"><strong>{{ __('Phone') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">{{ $user->phone }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="email" class="col-2 col-form-label text-end"><strong>{{ __('Email') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">{{ $user->email }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="last_login_at" class="col-2 col-form-label text-end"><strong>{{ __('Last login') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">{{ $user->last_login_at }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="departments" class="col-2 col-form-label text-end"><strong>{{ __('Departments') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">--}}
{{--                                @forelse ($user->departments as $department)--}}
{{--                                    <span class="badge bg-primary">{{ $department->name }}</span>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="roles" class="col-2 col-form-label text-end"><strong>{{ __('Roles') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">--}}
{{--                                @forelse ($user->getRoleNames() as $role)--}}
{{--                                    <span class="badge bg-primary">{{ $role }}</span>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-1">--}}
{{--                        <label for="stores" class="col-2 col-form-label text-end"><strong>{{ __('Stores') }}</strong></label>--}}
{{--                        <div class="col-10">--}}
{{--                            <div class="form-control">--}}
{{--                                @forelse ($user->stores as $store)--}}
{{--                                    <span class="badge bg-primary">{{ $store->symbol }}</span>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                </div>
            </div>
        </div>
    </div>
@endsection
