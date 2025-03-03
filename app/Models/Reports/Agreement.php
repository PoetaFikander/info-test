<?php
declare(strict_types=1);

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    static function getAgreementItemRates(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $itemRates = self::getAgreementItemRatesSQL($input);
        return [
            'itemRates' => $itemRates,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementItemRatesSQL(array $input): array
    {
        $def = [
            'ai_id' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItemRates](
                     :ai_id
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
            'agr_item_id' => 0
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItems](
                     :agr_id
                    ,:agr_no
                    ,:status_ids
                    ,:agr_item_id
                )
           ", $params
        );
    }


    static function getAgreementItemAddresses(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $itemAddresses = self::getAgreementItemAddressesSQL($input);
        return [
            'itemAddresses' => $itemAddresses,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementItemAddressesSQL(array $input): array
    {
        $def = [
            'ai_id' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItemAddresses](
                     :ai_id
                )
           ", $params
        );
    }

    static function getAgreementItemBasic(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $itemBasic = self::getAgreementItemBasicSQL($input);
        return [
            'itemBasic' => $itemBasic,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getAgreementItemBasicSQL(array $input): array
    {
        $def = [
            'ai_id' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getAgreementItemBasic](
                     :ai_id
                )
           ", $params
        );
    }


    // TODO przenieść do Customer
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

    /*
     * ---------------------------------------------------------------------------------------------------
     * ------------- updates ----------------
     */
    static function updateAgreementItem(array $input): array
    {
        $p = [
            'ai_id' => $input['currentData']['ai_id'],
            'ai_dev_id' => $input['currentData']['dev_id'],
            'column_name' => $input['updateData']['columnName'],
            'new_value' =>  $input['dataFromForm']['new_value'],
        ];
        $result = [
            'result' => (array)self::updateAgreementItemSQL($p)[0],
            'updateData' => $input['updateData'],
        ];
        return $result;
    }

    private static function updateAgreementItemSQL(array $input): array
    {
        $def = [
            'ai_id' => 0,
            'ai_dev_id' => 0,
            'column_name' => '',
            'new_value' => '',
            'user_id' => Auth::user()->id,
        ];
        $params = matchArrayParameters($def, $input);
        return DB::connection('sqlsrv')->select(
            "
                EXECUTE [dbo].[updateAgreementItem]
                     :ai_id
                    ,:ai_dev_id
                    ,:column_name
                    ,:new_value
                    ,:user_id
           ", $params
        );
    }

    static function updateAgreementItemRate(array $input): array
    {
        unset($input['ai']);
        $result = [
            'result' => self::updateAgreementItemRateSQL($input),
            '$input' => $input,
        ];
        return $result;
    }

    private static function updateAgreementItemRateSQL(array $input): array
    {
        $def = [
            'rate_id' => 0,
            'rate_item_id' => 0,
            'rate_art_id' => 0,
            'rate_value' => 0,
            'rate_free_copies_in_cnu' => 0,
            'rate_is_lump_sum' => 0,
            'rate_company_unit_id' => 0,
            'rate_notes' => null,
            'user_id' => Auth::user()->id,
            'ai_extra_value_service_id' => 0,
            'ai_extra_value_in_cnu' => 0,
        ];
        $params = matchArrayParameters($def, $input);
        //return $params;
        return DB::connection('sqlsrv')->select(
            "
                EXECUTE [dbo].[updateAgreementItemRate]
                     :rate_id
                    ,:rate_item_id
                    ,:rate_art_id
                    ,:rate_value
                    ,:rate_free_copies_in_cnu
                    ,:rate_is_lump_sum
                    ,:rate_company_unit_id
                    ,:rate_notes
                    ,:user_id
                    ,:ai_extra_value_service_id
                    ,:ai_extra_value_in_cnu
           ", $params
        );
    }


}
