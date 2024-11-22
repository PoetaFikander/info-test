<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Exports\MifsExport;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Reports\Mif;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;


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

    public function exportBasicToExcel(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Mif::exportBasicToExcel($input);
        return response()->json($result, 200);
    }

    public function getBasicReport(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Mif::getBasicReport($input);
        return response()->json($result, 200);
    }

    public function getPatrons(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Mif::getPatrons($input);
        return response()->json($result, 200);
    }


}

