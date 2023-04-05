<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FacebookAdController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CustomerDetailsController;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('facebook-ads', FacebookAdController::class);
        Route::resource('customers', CustomerController::class);
        Route::get('all-customer-details', [
            CustomerDetailsController::class,
            'index',
        ])->name('all-customer-details.index');
        Route::post('all-customer-details', [
            CustomerDetailsController::class,
            'store',
        ])->name('all-customer-details.store');
        Route::get('all-customer-details/create', [
            CustomerDetailsController::class,
            'create',
        ])->name('all-customer-details.create');
        Route::get('all-customer-details/{customerDetails}', [
            CustomerDetailsController::class,
            'show',
        ])->name('all-customer-details.show');
        Route::get('all-customer-details/{customerDetails}/edit', [
            CustomerDetailsController::class,
            'edit',
        ])->name('all-customer-details.edit');
        Route::put('all-customer-details/{customerDetails}', [
            CustomerDetailsController::class,
            'update',
        ])->name('all-customer-details.update');
        Route::delete('all-customer-details/{customerDetails}', [
            CustomerDetailsController::class,
            'destroy',
        ])->name('all-customer-details.destroy');

        Route::get('all-orders', [OrdersController::class, 'index'])->name(
            'all-orders.index'
        );
        Route::post('all-orders', [OrdersController::class, 'store'])->name(
            'all-orders.store'
        );
        Route::get('all-orders/create', [
            OrdersController::class,
            'create',
        ])->name('all-orders.create');
        Route::get('all-orders/{orders}', [
            OrdersController::class,
            'show',
        ])->name('all-orders.show');
        Route::get('all-orders/{orders}/edit', [
            OrdersController::class,
            'edit',
        ])->name('all-orders.edit');
        Route::put('all-orders/{orders}', [
            OrdersController::class,
            'update',
        ])->name('all-orders.update');
        Route::delete('all-orders/{orders}', [
            OrdersController::class,
            'destroy',
        ])->name('all-orders.destroy');

        Route::resource('bank-accounts', BankAccountController::class);
    });
