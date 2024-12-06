<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agreement extends Model
{
    use HasFactory;


    static function getAgreementHeader(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $header = self::getAgreementHeaderSQL($input);
        return [
            'header' => $header,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementHeaderSQL(array $input): array
    {
        $def = [
            'agr_id' => 0,
            'agr_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementHeader](
                     :agr_id
                    ,:agr_no
                )
           ", $params
        );
    }


    static function getAgreementItemParametersDefault(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $itemParams = self::getAgreementItemParametersDefaultSQL($input);
        return [
            'itemParams' => $itemParams,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementItemParametersDefaultSQL(array $input): array
    {
        $def = [
            'agr_id' => 0,
            'agr_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItemParametersDefault](
                     :agr_id
                    ,:agr_no
                )
           ", $params
        );
    }

    static function getAgreementItemRatesDefault(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $itemRates = self::getAgreementItemRatesDefaultSQL($input);
        return [
            'itemRates' => $itemRates,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementItemRatesDefaultSQL(array $input): array
    {
        $def = [
            'agr_id' => 0,
            'agr_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItemRatesDefault](
                     :agr_id
                    ,:agr_no
                )
           ", $params
        );
    }


    static function getAgreementInvoices(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $invoices = self::getAgreementInvoicesSQL($input);
        return [
            'invoices' => $invoices,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementInvoicesSQL(array $input): array
    {
        $def = [
            'agr_id' => 0,
            'agr_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementInvoices](
                     :agr_id
                    ,:agr_no
                )
           ", $params
        );
    }

    static function getAgreementHistory(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $history = self::getAgreementHistorySQL($input);
        return [
            'history' => $history,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementHistorySQL(array $input): array
    {
        $def = [
            'agr_id' => 0,
            'agr_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementHistory](
                     :agr_id
                    ,:agr_no
                )
           ", $params
        );
    }



    static function getAgreementItems(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $items = self::getAgreementItemsSQL($input);
        return [
            'items' => $items,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementItemsSQL(array $input): array
    {
        $def = [
            'agr_id' => 0,
            'agr_no' => '',
            'status_ids' => '0;1;', // ---- aktywne i odłączone
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItems](
                     :agr_id
                    ,:agr_no
                    ,:status_ids
                )
           ", $params
        );
    }


    static function getCustomerAgreements(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $agreements = self::getCustomerAgreementsSQL($input);
        return [
            'agreements' => $agreements,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getCustomerAgreementsSQL(array $input): array
    {
        $def = [
            'cust_id' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getCustomerAgreements](
                     :cust_id
                )
           ", $params
        );
    }


}
