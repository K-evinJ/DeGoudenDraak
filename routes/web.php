<?php

use App\Models\Dish;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalesController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\EmployeeController;

Route::get('/', [MenuController::class, 'sales']);
Route::get('/menukaart', [MenuController::class, 'index'])->name('menu');
Route::get('/menukaart/download', [MenuController::class, 'downloadMenu'])->name('download.menu');
Route::get('/nieuws', [MenuController::class, 'news'])->name('news');
Route::get('/aanbiedingen', [MenuController::class, 'sales'])->name('sales');
Route::get('/contact', [MenuController::class, 'contact'])->name('contact');

Route::get('/review', [ReviewController::class, 'index'])->name('review');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

Route::get('/gerechten', [MenuController::class, 'dishes'])->name('dishes');
Route::post('/gerechten/favoriet-maken', [MenuController::class, 'favorite'])->name('favorite');
Route::post('/gerechten/favoriet-verwijderen', [MenuController::class, 'unfavorite'])->name('unfavorite');

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

    Route::get('/employee/planning', [PlanningController::class, 'employeePlanning'])->name('employee.planning');
    Route::middleware([IsAdmin::class])->group(function (){
        Route::get('/dishes', [DishController::class, 'dishesPage'])->name('admin.dishes');
        Route::post('/dishes', [DishController::class, 'storeOrUpdate'])->name('admin.storeOrUpdate');
        Route::post('/dishes/type',[DishController::class, 'storeDishType'])->name('admin.storeDishType');

        Route::get('/planning', [PlanningController::class, 'index'])->name('admin.planning');
        Route::post('/planning', [PlanningController::class, 'store'])->name('admin.planning');
        Route::post('/employee/create', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/discounts', [DiscountsController::class, 'index'])->name('admin.discounts');
        Route::post('/discounts', [DiscountsController::class, 'store'])->name('admin.storeDiscount');
    });
});
