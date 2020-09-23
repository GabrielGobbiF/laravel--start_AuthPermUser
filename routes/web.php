<?php

use App\Http\Controllers\Painel\ACL\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes L
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('painel')->group(function () {
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
        Route::get('/{url}/details/destroy/{id}', [App\Http\Controllers\Painel\PlanDetailController::class, 'destroy'])->name('plans.details.destroy');

        Route::any('/search', [App\Http\Controllers\Painel\PlanController::class, 'search'])->name('plans.search');
        Route::get('/delete/{id}', [App\Http\Controllers\Painel\PlanController::class, 'destroy'])->name('plans.destroy');
        Route::get('/', [App\Http\Controllers\Painel\PlanController::class, 'index'])->name('plans.index');
        Route::get('/create', [App\Http\Controllers\Painel\PlanController::class, 'create'])->name('plans.create');
        Route::post('/create', [App\Http\Controllers\Painel\PlanController::class, 'store'])->name('plans.store');
        Route::get('/{id}', [App\Http\Controllers\Painel\PlanController::class, 'show'])->name('plans.show');
        Route::put('/{id}', [App\Http\Controllers\Painel\PlanController::class, 'update'])->name('plans.update');
    });
    /*
    |--------------------------------------------------------------------------
    | Profiles (Perfis)
    |--------------------------------------------------------------------------
    */
    Route::resource('profiles', ProfileController::class)->except([
        'destroy'
    ]);
    Route::get('profiles/delete/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

    /*
    |--------------------------------------------------------------------------
    | Permissons (Permissões)
    |--------------------------------------------------------------------------
    */
    Route::resource('permissions', App\Http\Controllers\Painel\ACL\PermissionController::class)->except([
        'destroy'
    ]);
    Route::get('permissions/delete/{id}', [App\Http\Controllers\Painel\ACL\PermissionController::class, 'destroy'])->name('permissions.destroy');
});





Route::fallback(function () {
    return view('errors/404');
});
