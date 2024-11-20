<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use App\Models\User;
use App\Models\Workplace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperAjaxDataController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index', 'show']]);
//        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
//        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * user data for js classes
     * @return JsonResponse
     */
    public function getCurrentUserData(): JsonResponse
    {
        return response()->json([
            'currentUserData' => User::getUserData(Auth::user()->id),
        ], 200
        );
    }

    /**
     * data required by js class: UsersList
     * @return JsonResponse
     */
    public function getDataForUsersList(): JsonResponse
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->{'name_surname'} = $user->name . ' ' . $user->surname;
            $user->getRoleNames();
        }

        return response()->json([
            'currentUserData' => User::getUserData(Auth::user()->id),
            'users' => $users,
        ], 200
        );
    }

    /**
     * data required by js class: UsersList
     * @return JsonResponse
     */
    public function getDataForEmployeesList(): JsonResponse
    {
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $employee->{'name_surname'} = $employee->name . ' ' . $employee->surname;
            $employee->department;
            $employee->workplace;
            $employee->section;
        }

        return response()->json([
            'currentUserData' => User::getUserData(Auth::user()->id),
            'employees' => $employees,
//            'departments' => Department::all(),
//            'workplaces' => Workplace::all(),
//            'sections' => Section::all(),
        ], 200
        );
    }



}
