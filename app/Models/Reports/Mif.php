<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mif extends Model
{
    use HasFactory;

    /**
     * @param array $input
     * @return array
     */
    static function getBasic(array $input): array
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
    static function getPatrons(array $input): array
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




}
