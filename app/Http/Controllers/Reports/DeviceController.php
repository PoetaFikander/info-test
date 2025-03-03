<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Reports\Customer;
use App\Models\Reports\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view(
            'reports.devices.index',
            [
               'devFilterOptions' => config('global.optionsForFilter.device'),
            ]
        );

    }

    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getDevicesByFilters(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Device::getDevicesByFilters($input);
        return response()->json($result, 200);
    }

    public function getDevices(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Device::getDevices($input);
        return response()->json($result, 200);
    }


}
