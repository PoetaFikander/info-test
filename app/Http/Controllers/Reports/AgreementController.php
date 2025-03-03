<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Reports\Agreement;
use App\Models\Reports\Mif;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgreementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permission:show-mif-full', ['only' => ['basic_full']]);
        //$this->middleware('permission:show-mif-limited', ['only' => ['basic_limited']]);
    }

    public function costsAndProfits_full(): View
    {
        return view('reports.agreements.costs-and-profits', []);
    }

    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function updateAgreementItemRate(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Agreement::updateAgreementItemRate($input);
        return response()->json($result, 200);
    }

    public function getAgreementItems(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Agreement::getAgreementItems($input);
        return response()->json($result, 200);
    }

    public function getAgreementItemRates(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Agreement::getAgreementItemRates($input);
        return response()->json($result, 200);
    }


}
