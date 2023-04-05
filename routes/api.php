<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FacebookAdController;
use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\CustomerDetailsController;
use App\Http\Controllers\Api\CustomerAllOrdersController;
use App\Http\Controllers\Api\FacebookAdCustomersController;
use App\Http\Controllers\Api\CustomerAllCustomerDetailsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('facebook-ads', FacebookAdController::class);

        // FacebookAd Customers
        Route::get('/facebook-ads/{facebookAd}/customers', [
            FacebookAdCustomersController::class,
            'index',
        ])->name('facebook-ads.customers.index');
        Route::post('/facebook-ads/{facebookAd}/customers', [
            FacebookAdCustomersController::class,
            'store',
        ])->name('facebook-ads.customers.store');

        Route::apiResource('customers', CustomerController::class);

        // Customer All Customer Details
        Route::get('/customers/{customer}/all-customer-details', [
            CustomerAllCustomerDetailsController::class,
            'index',
        ])->name('customers.all-customer-details.index');
        Route::post('/customers/{customer}/all-customer-details', [
            CustomerAllCustomerDetailsController::class,
            'store',
        ])->name('customers.all-customer-details.store');

        // Customer All Orders
        Route::get('/customers/{customer}/all-orders', [
            CustomerAllOrdersController::class,
            'index',
        ])->name('customers.all-orders.index');
        Route::post('/customers/{customer}/all-orders', [
            CustomerAllOrdersController::class,
            'store',
        ])->name('customers.all-orders.store');

        Route::apiResource(
            'all-customer-details',
            CustomerDetailsController::class
        );

        Route::apiResource('all-orders', OrdersController::class);

        Route::apiResource('bank-accounts', BankAccountController::class);
    });
