<?php
declare(strict_types=1);

namespace App\Models\Reports;

use App\Exports\MifsExport;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Mif extends Model
{
    use HasFactory;

    static function getBasicReport(array $input): array
    {
        $user = Auth::user();

        if (self::getDepartmentIds($input, $user)) {
            $status = 0; // ---- everything's fine
            $message = config('global.message.ok');
            $report = self::getBasicReportSQL($input);
        } else {
            $status = 99; // ---- the operation was unsuccessful
            $message = config('global.message.fail');
            $report = [];
        }

        return [
            'report' => $report,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    static function getPatrons(array $input): array
    {
//        $user = Auth::user();
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
        $message = config('global.message.ok');
        $patrons = self::getPatronsSQL($input);

        return [
            'patrons' => $patrons,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];

    }


    static function exportBasicToExcel(array $input): array
    {

        $collection = new Collection();
        $def = [
            'patron_txt' => '',
            'dep_acronym' => '',
            'agr_count' => 0,
            'dev_count' => 0,
            'a3_color' => 0,
            'a3_mono' => 0,
            'a4_color' => 0,
            'a4_mono' => 0,
        ];

        if ($input['report_type'] === 'department') {
            unset($def['patron_txt']);
        }

        $params = [
            'year' => $input['year'],
            'month' => $input['month'],
            'department_id' => $input['department_id'],
            'patron_altum_id' => $input['patron_altum_id'],
            'report_type' => $input['report_type'],
        ];

        $data = Mif::getBasicReport($params);
        foreach ($data['report'] as $item) {
            $params = matchArrayParameters($def, (array)$item);
            $collection->push($params);
        }

        $datetime = Carbon::now()->toDateTimeString();;
        $myFile = Excel::raw(new MifsExport($collection, $input['report_type']), 'Xlsx');

        return array(
            'name' => $datetime . ' mif.xlsx',
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($myFile)
        );

    }



    /**
     * ******************************************************************************
     * ------------------------------------------------------------------------------
     * ---------------- private methods ---------------------------------------------
     */

    /**
     * @param array $input
     * @return array
     */
    static function getBasicReportSQL(array $input): array
    {

        $def = [
            'year' => 0,
            'month' => 0,
            'department_altum_ids' => '',
            //'patron_altum_ids' => '',
            'patron_altum_id' => 0,
            'report_type' => 'department' // department, patron
            //'agr_type_ids' => '394;395;', // typy umów KOS i Najem
            //'agr_status_ids' => '391;', // umowa aktywna
        ];
        $params = matchArrayParameters($def, $input);

        return DB::connection('sqlsrv')->select(
            "EXECUTE [dbo].[getReportMIFBasic]
                     :year
                    ,:month
                    ,:department_altum_ids
                    ,:patron_altum_id
                    ,:report_type
                ", $params
        );

    }

    private static function getPatronsSQL(array $input): array
    {
        $def = [
            'department_altum_ids' => '',
            'agr_type_ids' => '394;395;', // typy umów KOS i Najem
            'agr_status_ids' => '391;', // umowa aktywna
        ];
        $params = matchArrayParameters($def, $input);

        return DB::connection('sqlsrv')->select(
            "SELECT * FROM [dbo].[getReportMIFPatrons](
                     :department_altum_ids
                    ,:agr_type_ids
                    ,:agr_status_ids
                ) ORDER BY [agr_patron_txt]
                ", $params
        );
    }

    /**
     * na podstawie uprawnień użytkownika modyfikuje tablicę danych wejściowych
     * procedury generującej raport, dodaje string z listą ids oddziałów
     * @param array $input
     * @param Authenticatable $user
     * @return bool
     */
    private static function getDepartmentIds(array &$input, Authenticatable $user): bool
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
