<?php

namespace App\Http\Controllers\Modals;

use App\Http\Controllers\Controller;
use App\Models\Reports\Agreement;
use App\Models\Reports\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getModalBlade(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = match ($input['modalName']) {
            'altumDocument' => view('modals.documents.default')->render(),
            'agreement' => view('modals.documents.agreement')->render(),
            'device' => view('modals.device.device')->render(),
            default => view('modals.default')->render(),
        };
        return response()->json($result, 200);
    }

    public function getModalData(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = match ($input['modalName']) {
            'altumDocument' => self::getAltumDocumentData($input),
            'agreement' => self::getAgreementData($input),
            default => $input,
        };
        return response()->json($result, 200);
    }

    static function getAltumDocumentData(array $input): array
    {
        $header = Document::getDocumentHeader($input)['header'];
        $header = count($header) ? $header[0] : $header;
        return [
            'header' => $header,
            'items' => Document::getDocumentItems($input)['items'],
        ];
    }

    static function getAgreementData(array $input): array
    {
        $header = Agreement::getAgreementHeader($input)['header'];
        $header = count($header) ? $header[0] : $header;
        $itemParams = Agreement::getAgreementItemParametersDefault($input)['itemParams'];
        $itemParams = count($itemParams) ? $itemParams[0] : $itemParams;
        $itemRates = Agreement::getAgreementItemRatesDefault($input)['itemRates'];
        $items = Agreement::getAgreementItems($input)['items'];
        $invoices = Agreement::getAgreementInvoices($input)['invoices'];
        $history = Agreement::getAgreementHistory($input)['history'];
        return [
            'header' => $header,
            'itemParams' => $itemParams,
            'itemRates' => $itemRates,
            'items' => $items,
            'invoices' => $invoices,
            'history' => $history,
        ];

    }


}
