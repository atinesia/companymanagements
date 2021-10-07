<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DailyQuoteController;

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
Route::group(['middleware' => ['auth:sanctum','verified']], function(){

    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('dashboard');

    Route::group(['middleware' => ['isAdmin']], function(){
        Route::get('/company/json',[CompanyController::class,'jsonData'])->name('companyJson');
        Route::post('/company/{id}/upload',[CompanyController::class,'uploadFile'])->name('company.upload');
        Route::resource('company',CompanyController::class);

        //employee
        Route::get('/employee/json',[EmployeeController::class,'jsonData'])->name('employeeJson');
        Route::resource('employee',EmployeeController::class);

        //quote
        Route::get('/quotes',[DailyQuoteController::class,'index'])->name('quote.index');
    });
});
