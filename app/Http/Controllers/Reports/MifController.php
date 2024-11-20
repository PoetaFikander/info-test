<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Reports\Mif;
use App\Models\Store;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-mif-full', ['only' => ['basic_full']]);
        $this->middleware('permission:show-mif-limited', ['only' => ['basic_limited']]);
    }

    /**
     * MIF Basic Report
     * full access to all departments and patrons
     * @return View
     */
    public function basic_full(): View
    {
        return view(
            'reports.mif.basic',
            [
                'years' => getYears(),
                'months' => getMonths(),
                'departments' => Department::all()->sortBy('symbol'),
                'patrons' => Employee::where('section_id', 2)->get(),
            ]
        );
    }

    /**
     * MIF Basic Report
     * limited access to all departments and patrons
     * @return View
     */
    public function basic_limited(): View
    {

        $user = Auth::user();
        $ids = $user->departments->pluck('id')->all();
        $departments = Department::whereIn('id', $ids)->get()->sortBy('symbol');
        return view(
            'reports.mif.basic',
            [
                'years' => getYears(),
                'months' => getMonths(),
                'departments' => $departments,
                //'patrons' => Employee::where('section_id', 2)->get(),
            ]
        );
    }


    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getBasicReport(Request $request): JsonResponse
    {
        $input = $request->all();
        $user = Auth::user();

        if (self::getDepartmentIds($input, $user)) {
            $status = 0; // ---- everything's fine
            $message = 'Dane zostały pobrane.';
            $report = Mif::getBasic($input);
            //$patrons = Mif::getPatrons($input);
        } else {
            $status = 99; // ---- the operation was unsuccessful
            $message = 'Wystąpił problem podczas pobierania danych!';
            $report = [];
            //$patrons = [];
        }

        $result = [
            //'$patrons' => $patrons,
            'report' => $report,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
        return response()->json($result, 200);
    }

    public function getPatrons(Request $request): JsonResponse
    {
        $input = $request->all();
        $user = Auth::user();

//        if(self::getDepartmentIds($input, $user)){
//            $status = 0; // ---- everything's fine
//            $message = 'Dane zostały pobrane.';
//            $report = Mif::getBasic($input);
//
//            $patrons = Mif::getPatrons($input);
//
//        } else {
//            $status = 99; // ---- the operation was unsuccessful
//            $message = 'Wystąpił problem podczas pobierania danych!';
//            $report = [];
//
//            $patrons = [];
//        }

        $status = 0; // ---- everything's fine
        $message = 'Dane zostały pobrane.';
        $patrons = Mif::getPatrons($input);

        $result = [
            'patrons' => $patrons,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
        return response()->json($result, 200);
    }

    /**
     * ------------------------------------------------------------------------------
     * ---------------- private methods ---------------------------------------------
     */


    /**
     * na podstawie uprawnień użytkownika modyfikuje tablicę danych wejściowych
     * procedury generującej raport, dodaje string z listą ids oddziałów
     * @param array $input
     * @param Authenticatable $user
     * @return bool
     */
    private function getDepartmentIds(array &$input, Authenticatable $user): bool
    {
        $departmentAltumIds = '';
        $departmentId = (int)$input['department_id'];
        $roles = $user->roles->pluck('name')->all();
        $success = true;

        if ($departmentId !== 0) {
            $input['department_altum_ids'] = Department::where('id', $departmentId)->value('altum_id') . ';';
        } else {
            if (in_array('Super Admin', $roles) || in_array('Reports MIF full', $roles)) {
                // ---- wszystkie oddziały
                $input['department_altum_ids'] = '';
            } elseif (in_array('Reports MIF limited', $roles)) {
                // ---- tylko oddziały usera
                foreach ($user->departments->pluck('altum_id')->all() as $id) {
                    $departmentAltumIds .= $id . ';';
                }
                $input['department_altum_ids'] = $departmentAltumIds;
            } else {
                $success = false;
            }
        }
        return $success;
    }


}

