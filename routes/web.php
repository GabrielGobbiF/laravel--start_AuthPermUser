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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('painel')->namespace('Painel')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    /*
    |--------------------------------------------------------------------------
    | Plans (Planos)
    |--------------------------------------------------------------------------
    */
    Route::prefix('plans')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | Details (Detalhe do Plano)
        |--------------------------------------------------------------------------
        */
        Route::get('/{url}/details', [App\Http\Controllers\Painel\PlanDetailController::class, 'index'])->name('plans.details.index');
        Route::get('/{url}/details/create', [App\Http\Controllers\Painel\PlanDetailController::class, 'create'])->name('plans.details.create');
        Route::post('/{url}/details/create', [App\Http\Controllers\Painel\PlanDetailController::class, 'store'])->name('plans.details.store');
        Route::get('/{url}/details/{id}', [App\Http\Controllers\Painel\PlanDetailController::class, 'show'])->name('plans.details.show');
        Route::put('/{url}/details/{id}', [App\Http\Controllers\Painel\PlanDetailController::class, 'update'])->name('plans.details.update');

        Route::any('/search', [App\Http\Controllers\Painel\PlanController::class, 'search'])->name('plans.search');
        Route::get('/delete/{id}', [App\Http\Controllers\Painel\PlanController::class, 'destroy'])->name('plans.destroy');
        Route::get('/', [App\Http\Controllers\Painel\PlanController::class, 'index'])->name('plans.index');
        Route::get('/create', [App\Http\Controllers\Painel\PlanController::class, 'create'])->name('plans.create');
        Route::post('/create', [App\Http\Controllers\Painel\PlanController::class, 'store'])->name('plans.store');
        Route::get('/{id}', [App\Http\Controllers\Painel\PlanController::class, 'show'])->name('plans.show');
        Route::put('/{id}', [App\Http\Controllers\Painel\PlanController::class, 'update'])->name('plans.update');
    });
});

Route::fallback(function () {
    return view('errors/404');
});
