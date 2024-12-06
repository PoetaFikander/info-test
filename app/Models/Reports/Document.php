<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    use HasFactory;


    static function getDocumentHeader(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $header = self::getDocumentHeaderSQL($input);
        return [
            'header' => $header,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDocumentHeaderSQL(array $input): array
    {
        $def = [
            'doc_id' => 0,
            'doc_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        //return $params;
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDocumentHeader](
                     :doc_id
                    ,:doc_no
                )
           ", $params
        );
    }

    static function getDocumentItems(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $items = self::getDocumentItemsSQL($input);
        return [
            'items' => $items,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDocumentItemsSQL(array $input): array
    {
        $def = [
            'doc_id' => 0,
            'doc_no' => '',
        ];
        $params = matchArrayParameters($def, $input);
        //return $params;
        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDocumentItems](
                     :doc_id
                    ,:doc_no
                ) ORDER BY [art_name]
           ", $params
        );
    }

    static function getDocumentsItemsGrouped(array $input): array
    {
        $status = 0; // ---- everything's fine
        $message = config('global.message.ok');
        $items = self::getDocumentsItemsGroupedSQL($input);
        return [
            'items' => $items,
            'status' => $status,
            'message' => $message,
            'input' => $input,
        ];
    }

    private static function getDocumentsItemsGroupedSQL(array $input): array
    {
        $def = [
            'doc_ids' => '',
            'without_services' => 1, // ---- bit 01
            'without_items_ids' => '',
        ];
        $params = matchArrayParameters($def, $input);

        return DB::connection('sqlsrv')->select(
            "
                SELECT * FROM [dbo].[getDocumentsItemsGrouped](
                     :doc_ids
                    ,:without_services
                    ,:without_items_ids
                ) ORDER BY [art_name]
           ", $params
        );
    }




}
