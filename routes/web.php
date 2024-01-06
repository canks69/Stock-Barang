<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Stock\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Sales\InvoiceController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseInvoice;
use App\Http\Controllers\Report\StockCard;
use App\Http\Controllers\Report\SalesReport;
use App\Http\Controllers\Report\PurchaseReport;
use App\Http\Controllers\Setting\UserController;

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

Auth::routes();


Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () 
{
    Route::get('/dashboards', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboards');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('/sales/stock', [SalesController::class, 'stockid'])->name('sales.stockid');
    Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
    Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
    Route::get('/sales/invoice/{id}', [InvoiceController::class, 'invoice'])->name('sales.invoice');
    Route::get('/sales/edit/{id}', [SalesController::class, 'edit'])->name('sales.edit');
    Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');
    Route::delete('/sales/delete/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');

    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/edit/{id}', [PurchaseController::class, 'edit'])->name('purchase.edit');
    Route::put('/purchase/update/{id}', [PurchaseController::class, 'update'])->name('purchase.update');
    Route::delete('/purchase/delete/{id}', [PurchaseController::class, 'destroy'])->name('purchase.destroy');
    Route::get('/purchase/invoice/{id}', [PurchaseInvoice::class, 'invoice'])->name('purchase.invoice');


    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
    Route::post('/stock/store', [StockController::class, 'store'])->name('stock.store');
    Route::get('/stock/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::put('/stock/update/{id}', [StockController::class, 'update'])->name('stock.update');
    Route::delete('/stock/delete/{id}', [StockController::class, 'destroy'])->name('stock.destroy');

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/report/stock', [StockCard::class, 'index'])->name('report.stock.index');
    Route::post('/report/stock', [StockCard::class, 'show'])->name('report.stock.show');
    
    Route::get('/report/sales', [SalesReport::class, 'index'])->name('report.sales.index');
    Route::post('/report/sales', [SalesReport::class, 'show'])->name('report.sales.show');

    Route::get('/report/purchase', [PurchaseReport::class, 'index'])->name('report.purchase.index');
    Route::post('/report/purchase', [PurchaseReport::class, 'show'])->name('report.purchase.show');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

});
