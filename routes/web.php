<?php

use App\Http\Controllers\HelperAjaxDataController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Reports\AgreementController;
use App\Http\Controllers\Reports\CustomerController;
use App\Http\Controllers\Reports\MifController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Staff\SectionController;
use App\Http\Controllers\Staff\WorkplaceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Staff\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'permissions' => PermissionController::class,
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
    'staff/sections' => SectionController::class,
    'staff/workplaces' => WorkplaceController::class,
    'staff/employees' => EmployeeController::class,
    // ----
]);

//Route::middleware(['auth', 'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {


    // ----------- Reports MIF ------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('reports/mif/basic-full', [MifController::class, 'basic_full'])->name('reports.mif.basic-full');
    Route::get('reports/mif/basic-limited', [MifController::class, 'basic_limited'])->name('reports.mif.basic-limited');

    Route::post('/axreportsmif/getbasicexcel', [MifController::class, 'exportBasicToExcel']);
    Route::post('/axreportsmif/getbasicreport', [MifController::class, 'getBasicReport']);
    Route::post('/axreportsmif/getpatrons', [MifController::class, 'getPatrons']);

    // ----------- Reports Agreements -----------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('reports/agr/cap-full', [AgreementController::class, 'costsAndProfits_full'])->name('reports.agr.cap-full');

    // ----------- Reports Customers -----------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('/reports/cust', [CustomerController::class, 'index'])->name('reports.cust');
    Route::get('/reports/cust/cap-full/{id}', [CustomerController::class, 'costsAndProfits_full'])->name('reports.cust.cap-full');
    Route::post('/axcust/getcust', [CustomerController::class, 'getCustomers']);

    /**
     * -------------------------------------------------------------------------------------------------------
     * ----------------------- AJAX --------------------------------------------------------------------------
     * -------------------------------------------------------------------------------------------------------
     */

    // ----------- Users -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axusers/activate', [UserController::class, 'activate']);

    // ----------- Employees -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axemployees/getAltumEmployee', [EmployeeController::class, 'getAltumEmployee']);
    Route::post('/axemployees/activate', [EmployeeController::class, 'activate']);

    // ----------- Helper -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axhelp/getCurrentUserData', [HelperAjaxDataController::class, 'getCurrentUserData']);
    Route::post('/axhelp/getDataForUsersList', [HelperAjaxDataController::class, 'getDataForUsersList']);
    Route::post('/axhelp/getDataForEmployeesList', [HelperAjaxDataController::class, 'getDataForEmployeesList']);


});
