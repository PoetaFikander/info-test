<?php

namespace App\Models\Reports;

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
//        return $params;
    }


}
