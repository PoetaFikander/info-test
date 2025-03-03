<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Device extends Model
{
    use HasFactory;


    static function getDevicesByFilters(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $devices = self::getDevicesByFiltersSQL($input);
        return [
            'devices' => $devices,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDevicesByFiltersSQL(array $input): array
    {
        $def = [
            'dev_name' => '',
            'dev_serial_no' => '',
            'cust_name' => '',
            'agr_id' => 0,
            'agr_no' => '',
            'agr_status_ids' => '0;1;', // ---- aktywne i odłączone
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                EXECUTE [dbo].[getDevicesByFilters]
                     :dev_name
                    ,:dev_serial_no
                    ,:cust_name
                    ,:agr_id
                    ,:agr_no
                    ,:agr_status_ids
           ", $params
        );
    }


    static function getDevices(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $devices = self::getDevicesSQL($input);
        return [
            'devices' => $devices,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDevicesSQL(array $input): array
    {
        $def = [
            'dev_name' => '',
            'dev_serial_no' => '',
            'cust_name' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDevices](
                     :dev_name
                    ,:dev_serial_no
                    ,:cust_name
                )
           ", $params
        );
    }

    static function getDevice(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $device = self::getDeviceSQL($input);
        return [
            'device' => $device,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDeviceSQL(array $input): array
    {
        $def = [
            'dev_id' => 0,
            'dev_serial_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDevice](
                     :dev_id
                    ,:dev_serial_no
                )
           ", $params
        );
    }

    static function getDeviceCounters(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $counters = self::getDeviceCountersSQL($input);
        return [
            'counters' => $counters,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDeviceCountersSQL(array $input): array
    {
        $def = [
            'dev_id' => 0,
            'dev_serial_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDeviceCounters](
                     :dev_id
                    ,:dev_serial_no
                )
           ", $params
        );
    }

    static function getDeviceWorkCards(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $wc = self::getDeviceWorkCardsSQL($input);
        return [
            'wc' => $wc,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDeviceWorkCardsSQL(array $input): array
    {
        $def = [
            'dev_id' => 0,
            'dev_serial_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDeviceWorkCards](
                     :dev_id
                    ,:dev_serial_no
                )
           ", $params
        );
    }

    static function getDeviceHistory(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $history = self::getDeviceHistorySQL($input);
        return [
            'history' => $history,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDeviceHistorySQL(array $input): array
    {
        $def = [
            'dev_id' => 0,
            'date_from' => '',
            'date_to' => '',
        ];
        $params = matchArrayParameters($def, $input);
        //return $params;
        return DB::connection('sqlsrv')->select(
            "
                EXECUTE [dbo].[getDeviceHistory]
                     :dev_id
                    ,:date_from
                    ,:date_to
           ", $params
        );
    }

    static function getDeviceAgreementCurrent(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $agrCurrent = self::getDeviceAgreementCurrentSQL($input);
        return [
            'agrCurrent' => $agrCurrent,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDeviceAgreementCurrentSQL(array $input): array
    {
        $def = [
            'dev_id' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDeviceAgreementCurrent](
                     :dev_id
                )
           ", $params
        );
    }

    static function getDeviceModels(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $models = self::getDeviceModelsSQL($input);
        return [
            'models' => $models,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDeviceModelsSQL(array $input): array
    {
        $def = [
            //'dev_id' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDeviceModels](
                ) order by [dev_model_name]
           " //, $params
        );
    }

    /*
     * ---------------------------------------------------------------------------------------------------
     * ------------- updates ----------------
     */
    static function updateDevice(array $input): array
    {
        $p = [
            'dev_id' => $input['currentData']['dev_id'],
            'column_name' => $input['updateData']['columnName'],
            'new_value' => $input['dataFromForm']['new_value'],
        ];
        return [
            'result' => (array)self::updateDeviceSQL($p)[0],
            'updateData' => $input['updateData'],
        ];
    }

    private static function updateDeviceSQL(array $input): array
    {
        $def = [
            'dev_id' => 0,
            'column_name' => '',
            'new_value' => '',
            'user_id' => Auth::user()->id,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                EXECUTE [dbo].[updateDevice]
                     :dev_id
                    ,:column_name
                    ,:new_value
                    ,:user_id
           ", $params
        );
    }



}
