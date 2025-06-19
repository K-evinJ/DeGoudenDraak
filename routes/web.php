<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalesController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\DishController;
use App\Http\Middleware\IsAdmin;

Route::get('/', [MenuController::class, 'sales']);
Route::get('/menukaart', [MenuController::class, 'index'])->name('menu');
Route::get('/nieuws', [MenuController::class, 'news'])->name('news');
Route::get('/aanbiedingen', [MenuController::class, 'sales'])->name('sales');
Route::get('/contact', [MenuController::class, 'contact'])->name('contact');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/cashRegister', [CashRegisterController::class, 'index'])->name('employee.cashRegister');
    Route::get('/receipt/{order}/download', [CashRegisterController::class, 'downloadReceipt'])->name('receipt.download');
    Route::post('/receipt/cancel', function () {
        session()->forget('download_receipt_order_id');
        return redirect()->route('employee.cashRegister');
    })->name('receipt.cancelDownload');

    Route::post('/storeOrder',[CashRegisterController::class, 'store'])->name('orderCashregister');
    Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');
    Route::get('/sales', [SalesController::class, 'index'])->name('saleOverview');
    Route::get('/salesInTijd', [SalesController::class, 'getOrders'])->name('salesForTimeframe');
    Route::get('/dishesOverview',[DishController::class, 'employeeView'])->name('employeeDishes');

    Route::middleware([IsAdmin::class])->group(function (){
        Route::get('/dishes', [DishController::class, 'dishesPage'])->name('admin.dishes');
        Route::post('/dishes', [DishController::class, 'storeOrUpdate'])->name('admin.storeOrUpdate');
        Route::post('/dishes/type',[DishController::class, 'storeDishType'])->name('admin.storeDishType');

        Route::get('/discounts', [DiscountsController::class, 'index'])->name('admin.discounts');
        Route::post('/discounts', [DiscountsController::class, 'store'])->name('admin.storeDiscount');
    });
});
