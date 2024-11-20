<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Section;
use App\Models\User;
use App\Models\Workplace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        //dump(getModelByTableName('employee_salary_archives'));
        return view('staff.employees.index');
    }

    public function create(): View
    {
        return view('staff.employees.create', [
            'altumEmployees' => Employee::getAltumEmployees(),
            'departments' => Department::all(),
            'sections' => Section::all(),
            'workplaces' => Workplace::all(),
        ]);
    }

    public function store(StoreEmployeeRequest $request)//: RedirectResponse
    {
        $input = $request->all();
        $employee = Employee::create($input);
        return redirect()->route('employees.index')
            ->withSuccess('New employee is added successfully.');
    }

    public function show(Employee $employee): View
    {
        return view('staff.employees.show', [
            'employee' => $employee,
            'salaries' =>$employee->salaries,
        ]);
    }

    public function edit(Employee $employee)
    {
        //dump($employee);
        return view('staff.employees.edit', [
            'employee' => $employee,
            'departments' => Department::all(),
            'sections' => Section::all(),
            'workplaces' => Workplace::all(),
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $input = $request->all();
        $employee->update($input);
        return redirect()->back()
            ->withSuccess('Employee is updated successfully.');
    }


    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getAltumEmployee(Request $request): JsonResponse
    {
        $input = $request->all();
        $employee = Employee::getAltumEmployee($input['id']);
        if (count($employee) === 1) {
            $employee = $employee[0];
            $message = 'Dane zostały pobrane.';
            $status = 0; // ---- everything's fine
        } else {
            $employee = (object)[];
            $message = 'Wystąpił problem podczas pobierania danych!';
            $status = 99; // ---- the operation was unsuccessful
        }
        $result = [
            'employee' => $employee,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
        return response()->json($result, 200);
    }

    /**
     * function to activate or deactivate employees
     * if the employee is active, he is deactivated and vice versa
     * @param Request $request
     * @return JsonResponse
     */
    public function activate(Request $request): JsonResponse
    {
        $input = $request->all();
        //dump($input);
        $employee = Employee::find($input['id']);

        if (isset($employee->id)) {
            $message = 'Dane pracownika zostały zaktualizowane.';
            $status = 0; // ---- everything's fine
            $employee->is_active = ($employee->is_active == 1) ? 0 : 1;
            $employee->update((array)$employee);

        } else {
            $message = 'Operacja się nie powiodła';
            $status = 99; // ---- the operation was unsuccessful
        }

        $result = [
            'employee' => $employee,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
        return response()->json($result, 200);
    }


}
