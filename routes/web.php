<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return redirect()->route('company.index');
    });

    Route::resource('/company', \App\Http\Controllers\CompanyController::class);
    Route::resource('/employee', \App\Http\Controllers\EmployeeController::class);
});
