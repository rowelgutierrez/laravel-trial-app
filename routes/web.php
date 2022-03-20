<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtorsController;

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
    // return view('welcome');
    return redirect('creditor/dashboard');
});

$shared_routes = [
    [
        'route' => '',
        'view' => 'dashboard'
    ],
    [
        'route' => 'dashboard',
        'view' => 'dashboard'
    ],
];

Route::name('creditor.')->prefix('creditor')->group(function() use($shared_routes) {
    Route::group(['middleware' => ['role:creditor']], function() use($shared_routes) {
        foreach ($shared_routes as $route) {
            Route::get('/' . $route['route'], function () use($route) {
                return view($route['view']);
            })->middleware(['auth'])->name($route['route']);
        }

        Route::get('debtors', [DebtorsController::class, 'index'])->name('debtors');
        Route::get('debtor/new', [DebtorsController::class, 'new'])->name('debtor.new');
        Route::post('debtor', [DebtorsController::class, 'create'])->name('debtor');
    });
});

Route::name('debtor.')->prefix('debtor')->group(function() use($shared_routes) {
    Route::group(['middleware' => ['role:debtor']], function() use($shared_routes) {
        foreach ($shared_routes as $route) {
            Route::get('/' . $route['route'], function () use($route) {
                return view($route['view']);
            })->middleware(['auth'])->name($route['route']);
        }
    });
});

require __DIR__.'/auth.php';
