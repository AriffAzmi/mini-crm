<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'company',
    'as' => 'company.'
], function () {
    Route::get('/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('store');

    Route::get('/{company}/show', [App\Http\Controllers\CompanyController::class, 'show'])->name('show');
    Route::get('/{company}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('edit');
    Route::post('/{company}/edit', [App\Http\Controllers\CompanyController::class, 'update'])->name('update');
    Route::post('/{company}/delete', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('delete');
});

Route::group([
    'prefix' => 'employee',
    'as' => 'employee.'
], function () {
    Route::get('/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('store');

    Route::get('/{employee}/show', [App\Http\Controllers\EmployeeController::class, 'show'])->name('show');
    Route::get('/{employee}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('edit');
    Route::post('/{employee}/update', [App\Http\Controllers\EmployeeController::class, 'update'])->name('update');
    Route::post('/{employee}/delete', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('delete');
});