@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit User
                    </div>
                    <div class="float-end">
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method("PUT")

                        <input type="hidden" id="is_active" name="is_active" value="{{ $user->is_active }}">

                        <div class="mb-1 row">
                            <input type="submit" class="col-3 offset-5 btn btn-primary" value="Update User">
                        </div>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-main-tab" data-bs-toggle="tab" data-bs-target="#nav-main" type="button" role="tab"
                                        aria-controls="nav-main" aria-selected="true">Main
                                </button>
                                <button class="nav-link" id="nav-stores-tab" data-bs-toggle="tab" data-bs-target="#nav-stores" type="button" role="tab"
                                        aria-controls="nav-stores" aria-selected="false">Stores
                                </button>
                            </div>
                        </nav>

                        <div class="tab-content mt-2" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">

                                <div class="mb-1 row">
                                    <label class="col-3 col-form-label text-end">ID</label>
                                    <div class="col-8">
                                        <div class="form-control">{{ $user->id }}</div>
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="name" class="col-3 col-form-label text-end">Name</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                               value="{{ $user->name }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="surname" class="col-3 col-form-label text-end">Surname</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname"
                                               value="{{ $user->surname }}">
                                        @if ($errors->has('surname'))
                                            <span class="text-danger">{{ $errors->first('surname') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="phone" class="col-3 col-form-label text-end">Phone</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                               value="{{ $user->phone }}">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="email" class="col-3 col-form-label text-end">Email Address</label>
                                    <div class="col-8">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                               value="{{ $user->email }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="password" class="col-3 col-form-label text-end">Password</label>
                                    <div class="col-8">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="password_confirmation" class="col-3 col-form-label text-end">Confirm Password</label>
                                    <div class="col-8">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="departments" class="col-3 col-form-label text-end">Departments</label>
                                    <div class="col-8">
                                        <select class="form-select @error('departments') is-invalid @enderror" multiple aria-label="Departments"
                                                id="departments" name="departments[]">
                                            @forelse ($departments as $department)
                                                <option
                                                    value="{{ $department->id }}" {{ in_array($department->id, $userDepartments ?? []) ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('departments'))
                                            <span class="text-danger">{{ $errors->first('departments') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-1 row">
                                    <label for="roles" class="col-3 col-form-label text-end">Roles</label>
                                    <div class="col-8">
                                        <select class="form-select @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles"
                                                name="roles[]">
                                            @forelse ($roles as $role)

                                                @if ($role!='Super Admin')
                                                    <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @else
                                                    @if (Auth::user()->hasRole('Super Admin'))
                                                        <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                            {{ $role }}
                                                        </option>
                                                    @endif
                                                @endif

                                            @empty

                                            @endforelse
                                        </select>
                                        @if ($errors->has('roles'))
                                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="nav-stores" role="tabpanel" aria-labelledby="nav-stores-tab">

                                <div class="mx-1 row">
                                    <div class="col-12">
                                        <select class="form-select @error('stores') is-invalid @enderror" multiple size="30" aria-label="Stores"
                                                id="stores" name="stores[]">
                                            @forelse ($stores as $store)
                                                <option style="font-family: 'Courier New', monospace !important;"
                                                        value="{{ $store->id }}" {{ in_array($store->id, $userStores ?? []) ? 'selected' : '' }}>
                                                    {{ $store->symbol }}@for($i=1; $i< (10-strlen($store->symbol)); $i++)&nbsp;@endfor{{ $store->name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('stores'))
                                            <span class="text-danger">{{ $errors->first('stores') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
