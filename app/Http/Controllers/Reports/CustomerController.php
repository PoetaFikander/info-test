<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Reports\Agreement;
use App\Models\Reports\Customer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permission:show-mif-full', ['only' => ['basic_full']]);
        //$this->middleware('permission:show-mif-limited', ['only' => ['basic_limited']]);
    }


    public function index(): View
    {
        return view(
            'reports.customers.index',
            [
                'custFilterOptions' => config('global.optionsForFilter.customer'),
            ]
        );

    }

    public function costsAndProfits_full(string $id = '-1'): View
    {
        $id = is_numeric($id) ? (int)$id : -1;
        $customer = Customer::getCustomers(['id' => $id])['customers'];
        $c = (object)[
            'cust_id' => -1,
            'cust_code' => '',
            'cust_name' => '',
            'cust_tin' => '',
            'cust_zip_city' => '',
        ];
        $customer = count($customer) ? $customer[0] : $c;
        $agreements = Agreement::getCustomerAgreements(['cust_id' => $id])['agreements'];
        return view(
            'reports.customers.costs-and-profits',
            [
                'customer' => $customer,
                'agreements' =>$agreements,
                'dateFrom' => Carbon::createFromDate(Carbon::today()->year, 1, 1)->toDateString(),
                'dateTo' => Carbon::createFromDate(Carbon::today()->year, 12, 31)->toDateString(),
                'departments' => Department::all()->sortBy('symbol'),
            ]
        );

    }

    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getCustomersProfits(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Customer::getCustomersProfits($input);
        return response()->json($result, 200);
    }

    public function getCustomersCosts(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Customer::getCustomersCosts($input);
        return response()->json($result, 200);
    }

    public function getCustomers(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = Customer::getCustomers($input);
        return response()->json($result, 200);
    }


}
