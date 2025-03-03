<?php

use App\Http\Controllers\HelperAjaxDataController;
use App\Http\Controllers\IT\AliasController;
use App\Http\Controllers\IT\DynamicTableColumnController;
use App\Http\Controllers\IT\DynamicTableController;
use App\Http\Controllers\Modals\ModalController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Reports\AgreementController;
use App\Http\Controllers\Reports\AltumUniversalController;
use App\Http\Controllers\Reports\CustomerController;
use App\Http\Controllers\Reports\DeviceController;
use App\Http\Controllers\Reports\DocumentController;
use App\Http\Controllers\Reports\MifController;
use App\Http\Controllers\Reports\WorkCardController;
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
    'dynamic-tables' => DynamicTableController::class,
    //'dynamic-tables/columns' => DynamicTableColumnController::class,

]);

//Route::middleware(['auth', 'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {

    // ----------- Config dynamic tables --------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('dynamic-tables/columns/create/{id?}', [DynamicTableColumnController::class, 'create'])->name('dynamic-tables.columns.create');
    Route::post('dynamic-tables/columns/store', [DynamicTableColumnController::class, 'store'])->name('dynamic-tables.columns.store');
    Route::put('dynamic-tables/columns/update', [DynamicTableColumnController::class, 'update'])->name('dynamic-tables.columns.update');
    Route::post('/axdtc/columnupdate', [DynamicTableColumnController::class, 'axUpdate']);
    Route::post('/axdtc/usercolumnsync', [DynamicTableColumnController::class, 'userColumnSync']);


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
    Route::post('/axagr/getagritems', [AgreementController::class, 'getAgreementItems']);
    Route::post('/axagr/upagritem', [AgreementController::class, 'updateAgreementItem']);
    Route::post('/axagr/upagritemrate', [AgreementController::class, 'updateAgreementItemRate']);

    // ----------- updates universal -----------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axuniupdate/', [AltumUniversalController::class, 'universalUpdate']);

    // ----------- Reports Customers -----------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('/reports/cust', [CustomerController::class, 'index'])->name('reports.cust');
    Route::get('/reports/cust/cap-full/{id}', [CustomerController::class, 'costsAndProfits_full'])->name('reports.cust.cap-full');
    Route::post('/axcust/getcust', [CustomerController::class, 'getCustomers']);
    Route::post('/axcust/getcustcosts', [CustomerController::class, 'getCustomersCosts']);
    Route::post('/axcust/getcustprofits', [CustomerController::class, 'getCustomersProfits']);

    // ----------- Reports Devices --------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('/reports/dev', [DeviceController::class, 'index'])->name('reports.dev');
    Route::post('/axdev/getdevs', [DeviceController::class, 'getDevices']);
    Route::post('/axdev/getdevsbyfilters', [DeviceController::class, 'getDevicesByFilters']);

    // ----------- Reports work cards --------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('/reports/wc', [WorkCardController::class, 'index'])->name('reports.wc');
    Route::post('/axwc/getwcs', [WorkCardController::class, 'getWCs']);


    // ----------- Documents -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axdoc/getdocitems', [DocumentController::class, 'getDocumentItems']);
    Route::post('/axdoc/getdocsitemsgr', [DocumentController::class, 'getDocumentsItemsGrouped']);

    // ----------- Users -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axusers/activate', [UserController::class, 'activate']);

    // ----------- Employees -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axemployees/getAltumEmployee', [EmployeeController::class, 'getAltumEmployee']);
    Route::post('/axemployees/activate', [EmployeeController::class, 'activate']);

    // ----------- IT Alises --------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::get('/it/aliases', [AliasController::class, 'index'])->name('it.aliases');
    Route::post('/axit/getaliases', [AliasController::class, 'getAliases']);

    // ----------- Helper -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axhelp/getCurrentUserData', [HelperAjaxDataController::class, 'getCurrentUserData']);
    Route::post('/axhelp/getUsersList', [HelperAjaxDataController::class, 'getUsersList']);
    Route::post('/axhelp/getEmployeesList', [HelperAjaxDataController::class, 'getEmployeesList']);
    Route::post('/axhelp/getDynamicTablesList', [HelperAjaxDataController::class, 'getDynamicTablesList']);
    Route::post('/axhelp/getDynamicTable', [HelperAjaxDataController::class, 'getDynamicTable']);

    // ----------- Modal -----------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------
    Route::post('/axmodal/getModalBlade', [ModalController::class, 'getModalBlade']);
    Route::post('/axmodal/getModalData', [ModalController::class, 'getModalData']);


});
