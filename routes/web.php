<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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
        //Route::get('/company/{id}',[CompanyController::class,'show'])->name('company.show');
    });
});