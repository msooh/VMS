<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\DepartmentController;

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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
        Route::post('checkout', [VisitorController::class, 'checkout'])->name('checkout');

    });

    /*Route::get('visitors', [VisitorController::class, 'index'])->name('visitors');

    Route::post('visitors/add_validation', [VisitorController::class, 'add_validation'])->name('visitor.add_validation');

    Route::get('visitors/fetchall', [VisitorController::class, 'fetch_all'])->name('visitors.fetchall');*/

    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
    
});