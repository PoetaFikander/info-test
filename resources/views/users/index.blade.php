@extends('layouts.app')
@section('content')
    <div class="container-fluid p-0" data-name="container-main">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                @can('create-user')
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New User</a>
                @endcan
                <table class="table table-striped table-bordered table-sm" data-name="table-users-list">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ostatnie logowanie</th>
                        <th scope="col">Ostatnia aktywność</th>
                        <th scope="col">Role</th>
                        <th scope="col">Działania</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                    @forelse ($users as $user)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">{{ $loop->iteration }}</th>--}}
{{--                            <td>{{ $user->name }}</td>--}}
{{--                            <td>{{ $user->email }}</td>--}}
{{--                            <td>--}}
{{--                                @forelse ($user->getRoleNames() as $role)--}}
{{--                                    <span class="badge bg-primary">{{ $role }}</span>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <form action="{{ route('users.destroy', $user->id) }}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>--}}
{{--                                    @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []) )--}}
{{--                                        @if (Auth::user()->hasRole('Super Admin'))--}}
{{--                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i--}}
{{--                                                    class="bi bi-pencil-square"></i>--}}
{{--                                                Edit</a>--}}
{{--                                        @endif--}}
{{--                                    @else--}}
{{--                                        @can('edit-user')--}}
{{--                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i--}}
{{--                                                    class="bi bi-pencil-square"></i>--}}
{{--                                                Edit</a>--}}
{{--                                        @endcan--}}
{{--                                        @can('delete-user')--}}
{{--                                            @if (Auth::user()->id!=$user->id)--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                                        onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Delete--}}
{{--                                                </button>--}}
{{--                                            @endif--}}
{{--                                        @endcan--}}
{{--                                    @endif--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <td colspan="5">--}}
{{--                        <span class="text-danger">--}}
{{--                            <strong>No User Found!</strong>--}}
{{--                        </span>--}}
{{--                        </td>--}}
{{--                    @endforelse--}}
                    </tbody>
                </table>
{{--                {{ $users->links() }}--}}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/users/users.js') }}" type="module"></script>
@endsection

