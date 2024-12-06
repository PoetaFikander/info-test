<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Reports\Customer;
use App\Models\Reports\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permission:show-mif-full', ['only' => ['basic_full']]);
        //$this->middleware('permission:show-mif-limited', ['only' => ['basic_limited']]);
    }



    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getDocumentItems(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Document::getDocumentItems($input);
        return response()->json($result, 200);
    }

    public function getDocumentsItemsGrouped(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Document::getDocumentsItemsGrouped($input);
        return response()->json($result, 200);
    }



}
