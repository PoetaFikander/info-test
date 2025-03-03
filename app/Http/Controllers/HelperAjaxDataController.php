<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\IT\DynamicTable;
use App\Models\Reports\Agreement;
use App\Models\Section;
use App\Models\User;
use App\Models\Workplace;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return response()->json(User::getUserData(), 200);
    }

    /**
     * data required by js class: UsersList
     * @return JsonResponse
     */
    public function getUsersList(): JsonResponse
    {
        $users = User::all();
        //$user_sessions = \DB::table('sessions')->where('user_id', Auth::user()->id)->get();
        foreach ($users as $user) {
            $user->{'name_surname'} = $user->name . ' ' . $user->surname;
            $lastSession = DB::table('sessions')->where('user_id', $user->id)->get();
            $lastActivity = '';
            if (isset($lastSession[0])) {
                $lastActivity = $lastSession[0]->last_activity;
                $lastActivity = Carbon::createFromTimestamp($lastActivity)->toDateTimeString();
            }
            $user->{'last_activity'} = $lastActivity;
            $user->getRoleNames();
        }

        return response()->json($users, 200);
    }

    /**
     * data required by js class: UsersList
     * @return JsonResponse
     */
    public function getEmployeesList(): JsonResponse
    {
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $employee->{'name_surname'} = $employee->name . ' ' . $employee->surname;
            $employee->department;
            $employee->workplace;
            $employee->section;
        }
        return response()->json($employees, 200);
    }

    public function getDynamicTablesList(): JsonResponse
    {
        $tables = DynamicTable::all();
        return response()->json($tables, 200);
    }

    public function getDynamicTable(Request $request): JsonResponse
    {
        $input = $request->all();
        $dynamicTable = DynamicTable::find($input['id']);
        $columns = $dynamicTable->columns;
        $user = Auth::user();
        $dynamicTable->userColumns = $user->dynamicTableColumns()->wherePivot('dynamic_table_id', $dynamicTable->id)->get();
        return response()->json($dynamicTable, 200);
        //return response()->json(['header' => $dynamicTable, 'columns' => $columns], 200);
    }


}
