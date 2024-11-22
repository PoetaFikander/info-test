<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
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
        return view(
            'reports.agreements.costs-and-profits',
            [
//                'years' => getYears(),
//                'months' => getMonths(),
//                'departments' => Department::all()->sortBy('symbol'),
//                'patrons' => Employee::where('section_id', 2)->get(),
            ]
        );

    }


}
