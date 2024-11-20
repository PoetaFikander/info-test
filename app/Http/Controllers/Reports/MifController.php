<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Exports\MifsExport;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Reports\Mif;
use App\Models\Store;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Carbon\Carbon;
use Illuminate\Support\Collection;
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
     * @param int $y year
     * @param int $m month
     * @param int $d_id department altum id
     * @param int $p_id patron altum id
     * @param string $r_type report type
     *
     */
    public function basicExcelExport(int $y = 0, int $m = 0, int $dId = 0, int $pId = 0, string $reportType = '')
    {

        $collection = new Collection();
        $def_department = [
            'dep_acronym' => '',
            'agr_count' => 0,
            'dev_count' => 0,
            'a3_color' => 0,
            'a3_mono' => 0,
            'a4_color' => 0,
            'a4_mono' => 0,
        ];

        $params = [
            'year' => $y,
            'month' => $m,
            'department_id' => $dId,
            'patron_altum_id' => $pId,
            'report_type' => $reportType,
        ];
        dump($params);

        $data = Mif::getBasicReport($params);
        dump($data);

        foreach ($data['report'] as $item) {
            $params = matchArrayParameters($def_department, (array)$item);
            $collection->push($params);
        }
        dump($collection);

        $datetime = Carbon::now()->toDateTimeString();;
        //dump($datetime);

        $fileName = $datetime.' mif.xlsx';
        //dump($fileName);

        //return (new MifsExport($collection, $reportType))->download($fileName);

    }


    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

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

