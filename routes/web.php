<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/how_to_order', [App\Http\Controllers\HomeController::class, 'howToOrder'])->name('how-order-page');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about-page');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact-page');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product-page');
Route::get('/product/category/{slug}', [App\Http\Controllers\ProductController::class, 'productsByCategory'])
    ->name('productsByCategory');
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'productDetail'])
    ->name('productDetail');



Route::group(['middleware' => 'customerauth'], function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.customer');

    // Route untuk proses checkout order
    Route::post('/order/{slug}/checkout', [App\Http\Controllers\OrderController::class, 'create'])->name('order.checkout');
    Route::post('/order/store', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{code}/detail', [App\Http\Controllers\OrderController::class, 'detail_order'])->name('order.detail');
    Route::get('/order/success/{invoice}', [App\Http\Controllers\OrderController::class, 'success'])->name('order.success');
    Route::get('/order/histories', [App\Http\Controllers\ProfileController::class, 'histories'])->name('order.history');
    Route::get('/order/invoices', [App\Http\Controllers\ProfileController::class, 'invoices'])->name('order.invoice');

    // Route untuk proses create invoice
    Route::post('/invoice/create', [App\Http\Controllers\InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/{code}/detail', [App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{code}/print', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoice.print');

    // Route untuk proses pembayaran dengan payment gateway
    Route::get('/payment/{invoice}', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment.create');
    Route::post('/payment/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
});

/**
 * Routes for the admin panel.
 */
Route::group(['prefix' => 'admin'], function () {

    /**
     * Admin Authentication Routes
     */
    Route::get('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'index'])->name('admin-login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'process'])->name('admin-login-process');
    Route::post('/logout', [\App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin-logout');

    Route::group(['middleware' => 'adminauth:ADMIN'], function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard-admin');
        // route orders
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
            Route::get('/{status}/status', [App\Http\Controllers\Admin\OrderController::class, 'status_order'])->name('admin.orders.status');
            Route::get('/{code}/details', [App\Http\Controllers\Admin\OrderController::class, 'order_detail'])->name('admin.order.details');
            Route::post('/update-order-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('updateOrderStatus');
        });
        // route invoice
        Route::get('/transaction', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transaction');
        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.report');


        // route master data
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);

        Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
        Route::group(['prefix' => 'products'], function () {
            Route::get('/galleries/{id}', [App\Http\Controllers\Admin\ProductGalleryController::class, 'index'])->name('product.galleries');
            Route::post('/galleries/store', [App\Http\Controllers\Admin\ProductGalleryController::class, 'store'])->name('galleries.store');
            Route::post('/galleries/upload', [App\Http\Controllers\Admin\ProductGalleryController::class, 'upload'])->name('galleries.upload');
            Route::delete('/galleries/{id}/delete', [App\Http\Controllers\Admin\ProductGalleryController::class, 'destroy'])->name('galleries.delete');

            Route::resource('/specifications', App\Http\Controllers\Admin\ProductSpecificationController::class);
            Route::get('/{id}/specifications', [App\Http\Controllers\Admin\ProductSpecificationController::class, 'getSpecProduct'])->name('product.specs');
            Route::get('/getSpecificationName/{specType}', [App\Http\Controllers\Admin\ProductSpecificationController::class, 'getSpecificationName'])
                ->name('getSpecName');
        });


        Route::resource('/customer', App\Http\Controllers\Admin\CustomerController::class);
        Route::patch('/customer/{id}/update_status',  [App\Http\Controllers\Admin\CustomerController::class, 'update_status'])->name('update.customer.status');
        Route::resource('/data_admin', App\Http\Controllers\Admin\AdminController::class);

        // route profile and settings
        Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('admin.setting');
    });
});
