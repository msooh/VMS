<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SelfcheckinController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('selfcheckin.index');
});
Route::get('login', function(){
    return view('auth.login');
});
Route::get('registration', function(){
    return view('auth.registration');
});

Route::get('registration', [SessionController::class, 'registration'])->name('register');

Route::post('custom-registration', [SessionController::class, 'custom_registration'])->name('register.custom');

Route::middleware('guest')->group(function () {

    Route::get('login', [SessionController::class, 'index'])->name('login');
    Route::post('login', [SessionController::class, 'store']);

});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('index', [EmployeeController::class, 'index'])->name('index');
        Route::get('create', [EmployeeController::class, 'create'])->name('create');    
        Route::post('store', [EmployeeController::class, 'store'])->name('store');
        Route::get('employees/index/{id}', [EmployeeController::class, 'show'])->name('show');
    });

    Route::prefix('settings')->group(function () {
        Route::get('departments', [SettingController::class, 'indexDepartment'])->name('department');
        Route::post('departments', [SettingController::class, 'storeDepartment']);
        Route::get('roles', [SettingController::class, 'indexRole'])->name('role');
        Route::post('roles', [SettingController::class, 'storeRole']);
        Route::get('courts', [SettingController::class, 'indexCourt'])->name('court');
        Route::post('courts', [SettingController::class, 'storeCourt']);
        Route::get('badges', [SettingController::class, 'indexBadge'])->name('badge');
        Route::post('badges', [SettingController::class, 'storeBadge']);
    });


    Route::prefix('offices')->name('offices.')->group(function () {
        Route::get('index', [OfficeController::class, 'index'])->name('index');
        Route::get('create', [OfficeController::class, 'create'])->name('create');    
        Route::post('store', [OfficeController::class, 'store'])->name('store');
        Route::get('offices/index/{id}', [OfficeController::class, 'show'])->name('show');
    
    });
    Route::prefix('visitors')->name('visitors.')->group(function () {
        Route::get('index', [VisitorController::class, 'index'])->name('index');
        Route::get('create', [VisitorController::class, 'create'])->name('create');    
        Route::post('store', [VisitorController::class, 'store'])->name('store');
        Route::post('checkout/{id}', [VisitorController::class, 'checkout'])->name('checkout');
        Route::post('show/{id}', [VisitorController::class, 'show'])->name('show');
        Route::get('notify', [VisitorController::class, 'notify'])->name('notify');

    });
    Route::get('getoffices', [VisitorController::class, 'getoffices'])->name('getoffices');
    Route::get('getemployees', [VisitorController::class, 'getemployees'])->name('getemployees');
    Route::get('get-staff/{department}', [AppointmentController::class, 'getStaffByDepartment']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'date'])->name('appointments.date');
    Route::get('/employees/{department}', [VisitorController::class, 'getEmployeesByDepartment'])->name('employees.get-by-department');


    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('index', [AppointmentController::class, 'index'])->name('index');
        Route::put('index/{id}', [AppointmentController::class, 'date'])->name('appointments.date');
        Route::get('create', [AppointmentController::class, 'create'])->name('create');    
        Route::post('store', [AppointmentController::class, 'store'])->name('store');
        Route::put('update/{appointment}', [AppointmentController::class, 'update'])->name('update');
        Route::post('approve/{id}', [AppointmentController::class, 'approve'])->name('approve');
        Route::post('reject/{id}', [AppointmentController::class, 'reject'])->name('reject');
        Route::get('show', [AppointmentController::class, 'show'])->name('show');
        Route::get('edit/{appointment}', [AppointmentController::class, 'edit'])->name('edit');
        Route::post('checkin/{id}', [AppointmentController::class, 'checkin'])->name('checkin');

    });
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('visitors', [ReportController::class, 'visitors'])->name('visitors');
        Route::get('appointments', [ReportController::class, 'create'])->name('appointments');    
        Route::get('staff', [ReportController::class, 'staff'])->name('staff');
        Route::get('offices', [ReportController::class, 'offices'])->name('offices');
        Route::get('badges', [ReportController::class, 'badges'])->name('badges');

    });

    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
    
});
Route::get('getemployees', [SelfcheckinController::class, 'getemployees'])->name('getemployees');
Route::prefix('selfcheckin')->name('selfcheckin.')->group(function () {
    Route::get('index', [SelfcheckinController::class, 'index'])->name('index');
    Route::get('appointment', [SelfcheckinController::class, 'appointment'])->name('appointment');
    Route::get('checkin', [SelfcheckinController::class, 'checkin'])->name('checkin');
    Route::get('checkout', [SelfcheckinController::class, 'checkout'])->name('checkout');
    Route::get('return', [SelfcheckinController::class, 'return'])->name('return');
    Route::get('searchappointment', [SelfcheckinController::class, 'searchappointment'])->name('searchappointment');

});