<?php

namespace App\Models\Reports;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;


    static function getCustomers(array $input): array
    {

        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $customers = self::getCustomersSQL($input);

        return [
            'customers' => $customers,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];

    }

    private static function getCustomersSQL(array $input): array
    {
        $def = [
            'id' => 0,
            'code' => '',
            'name' => '',
            'tin' => '',
        ];
        $params = matchArrayParameters($def, $input);

        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAltumCustomers](
                     :id
                    ,:code
                    ,:name
                    ,:tin
                ) ORDER BY [cust_name]
           ", $params
        );
    }


    static function getCustomersCosts(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $documents = self::getCustomersCostsSQL($input);
        return [
            'documents' => $documents,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getCustomersCostsSQL(array $input): array
    {
        $def = [
            'cust_id' => 0,
            'date_from' => Carbon::now()->toDateString(),
            'date_to' => Carbon::now()->toDateString(),
//            'doc_codes' => 'WZ;KWWZ;KIWZ;', // default
//            'doc_states' => 'Zatwierdzony;Zaksięgowany;', // default
//            'related_doc_code' => 'FS', // default
        ];
        $params = matchArrayParameters($def, $input);

        return DB::connection('sqlsrv')->select(
            "
                select * from [dbo].[getCustomersCosts](
                     :cust_id
                    ,:date_from
                    ,:date_to
                    ,default
                    ,default
                    ,default
                )
           ", $params
        );

    }

    static function getCustomersProfits(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $documents = self::getCustomersProfitsSQL($input);
        return [
            'documents' => $documents,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getCustomersProfitsSQL(array $input): array
    {
        $def = [
            'cust_id' => 0,
            'date_from' => Carbon::now()->toDateString(),
            'date_to' => Carbon::now()->toDateString(),
        ];
        $params = matchArrayParameters($def, $input);

        return DB::connection('sqlsrv')->select(
            "
                select * from [dbo].[getCustomersProfits](
                     :cust_id
                    ,:date_from
                    ,:date_to
                    ,default
                    ,default
                    ,default
                )
           ", $params
        );

    }


}
