<?php

use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CampsiteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\buyer\CartController;
use App\Http\Controllers\buyer\BuyerController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\seller\PenjualController;
use App\Http\Controllers\buyer\AuthBuyerController;
use App\Http\Controllers\MasterSuratTypeController;
use App\Http\Controllers\seller\AuthSellerController;

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

Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::post('/', [BookingController::class, 'store'])->name('customer.store');
Route::get('/terima-kasih/{id}', [CustomerController::class, 'thanksGiving'])->name('customer.thanksGiving');

// Auth::routes();

// login
Route::prefix('admin')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('')->middleware(['is_admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/{booking}/approve', [BookingController::class, 'approve'])->name('admin.booking.approve');
        Route::post('/{booking}/reject', [BookingController::class, 'reject'])->name('admin.booking.reject');

        // users
        Route::prefix('users')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
            Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/{user}/get', [UserController::class, 'get'])->name('admin.users.get');
            Route::put('/{user}/update', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('admin.users.delete');
            // log-activity
            Route::get('/log-activities', [LogActivityController::class, 'index'])->name('admin.users.log');
        });

        // Master Tipe Surat
        Route::prefix('master-area-kemah')->group(function () {
            Route::get('/', [CampsiteController::class, 'index'])->name('master.campSite.index');
            Route::post('/', [CampsiteController::class, 'store'])->name('master.campSite.store');
        });

        // pdf
        Route::prefix('pdf')->group(function () {
            Route::get('/transaction', [PdfController::class, 'PdfHistoryTransactions'])->name('pdf.transaction');
            Route::get('/payment', [PdfController::class, 'PdfHistoryPayments'])->name('pdf.payments');
            Route::get('/product', [PdfController::class, 'PdfProduct'])->name('pdf.product');
            Route::get('/seller', [PdfController::class, 'PdfSeller'])->name('pdf.seller');
            Route::get('/user', [PdfController::class, 'PdfUser'])->name('pdf.user');
            Route::get('/log-activity', [PdfController::class, 'PdfLog'])->name('pdf.log');
        });

        // excel
        Route::prefix('excel')->group(function () {
            // export
            Route::get('/transaction-export', [ExcelController::class, 'transactionExport'])->name('excel.export.transaction');
            Route::get('/payments-export', [ExcelController::class, 'paymentsExport'])->name('excel.export.payment');
            Route::get('/product-export', [ExcelController::class, 'productExport'])->name('excel.export.product');
            Route::get('/user-export', [ExcelController::class, 'userExport'])->name('excel.export.user');
            Route::get('/log-activity-export', [ExcelController::class, 'logActivityExport'])->name('excel.export.log-activity');
            Route::get('/seller-export', [ExcelController::class, 'sellerExport'])->name('excel.export.seller');
            // download template excel
            Route::get('/template-product', function () {
                return response()->download(public_path('template-import/template-product.xlsx'));
            })->name('download.template.product');
            // import
            Route::post('/product-import', [ExcelController::class, 'productImport'])->name('excel.import.product');
        });

        // recycle bin
        Route::prefix('recycle')->group(function () {
            // users
            Route::get('/users', [UserController::class, 'indexRestore']);
            Route::get('/users-json', [UserController::class, 'showAllDeleted']);
            Route::get('/users/{id}/restore', [UserController::class, 'restore']);
            Route::get('/users/{id}/destroy', [UserController::class, 'destroy']);

            // products
            Route::get('/products', [ProductController::class, 'indexRestore']);
            Route::get('/products-json', [ProductController::class, 'showRestore']);
            Route::get('/products/{id}/restore', [ProductController::class, 'restore']);
            Route::get('/products/{id}/destroy', [ProductController::class, 'destroy']);
        });
    });
});

Route::prefix('buyer')->group(function () {
    Route::prefix('auth')->group(function () {
        // login
        Route::post('/login', [AuthBuyerController::class, 'login'])->name('buyer.login')->middleware('guest');
        // daftar
        Route::get('/daftar', [AuthBuyerController::class, 'viewRegister'])->name('buyer.register.view')->middleware('guest');
        Route::post('/register', [AuthBuyerController::class, 'register'])->name('buyer.register')->middleware('guest');
        Route::get('/verify/{username}', [AuthBuyerController::class, 'viewOtp'])->name('buyer.otp.view')->middleware('guest');
        Route::post('/verify', [AuthBuyerController::class, 'verifyOtp'])->name('buyer.otp')->middleware('guest');
        // login google
        Route::get('/google/redirect', 'Auth\Buyer\SocialiteController@redirect')->name('buyer.google.redirect')->middleware('guest');
        Route::get('/google/callback', 'Auth\Buyer\SocialiteController@callback')->name('buyer.google.callback')->middleware('guest');
        // logout
        Route::get('/logout', [AuthBuyerController::class, 'logout'])->name('buyer.logout');
        // ubah password
        Route::post('/change-password', [AuthBuyerController::class, 'changePassword'])->name('buyer.changePassword');
        // lupa password
        Route::get('forgot-password', 'Auth\Buyer\AuthController@viewForgotPassword')->name('buyer.forgotPassword.view');
        Route::post('forgot-password', 'Auth\Buyer\AuthController@sendResetLink')->name('buyer.forgotPassword.email');
        Route::get('reset-password/{token}', 'Auth\Buyer\AuthController@showResetForm')->name('buyer.forgotPassword.reset');
        Route::post('reset-password', 'Auth\Buyer\AuthController@resetPassword')->name('buyer.forgotPassword.update');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/my-cart', [CartController::class, 'index'])->name('buyer.cart.index')->middleware('auth.buyer');
        Route::post('/my-cart', [CartController::class, 'store'])->name('buyer.cart.store')->middleware('auth.buyer');
        Route::post('/my-cart/update-quantity', [CartController::class, 'updateQuantity'])->name('buyer.cart.updateQuantity')->middleware('auth.buyer');
        Route::delete('/my-cart/{id}', [CartController::class, 'destroy'])->name('buyer.cart.remove')->middleware('auth.buyer');
    });

    Route::prefix('transaction')->group(function () {
        Route::get('/pre-checkout', [TransactionController::class, 'preCheckout'])->name('buyer.buy.now')->middleware('auth.buyer');
        Route::post('/checkout', [TransactionController::class, 'checkoutBuyer'])->name('buyer.checkout')->middleware('auth.buyer');
    });

    Route::prefix('pengajuan')->group(function () {
        // Route::get('/pre-checkout', [TransactionController::class, 'preCheckout'])->name('buyer.buy.now')->middleware('auth.buyer');
        Route::post('/', [BookingController::class, 'store'])->name('masyarakat.pengajuan.store')->middleware('auth.buyer');
    });

    Route::get('/', [BuyerController::class, 'index'])->name('buyer.index')->middleware('auth.buyer');
    Route::get('/search-product', [BuyerController::class, 'searchProduct'])->name('buyer.product.search')->middleware('auth.buyer');
    Route::get('/detail-produk/{slug}', [BuyerController::class, 'detailProduct'])->name('buyer.product.detail')->middleware('auth.buyer');
    Route::get('/search-seller', [PenjualController::class, 'searchSeller'])->name('buyer.seller.search');
    Route::get('/my-profile', [BuyerController::class, 'indexProfile'])->name('buyer.profile')->middleware('auth.buyer');
    Route::get('/pengajuan-saya', [BuyerController::class, 'indexPengajuanSaya'])->name('masyarakat.pengajuan.pengajuanSaya')->middleware('auth.buyer');
    Route::get('/detail-pengajuan-saya/{id}', [BuyerController::class, 'detailPengajuanSaya'])->name('masyarakat.detail.pengajuanSaya')->middleware('auth.buyer');
});

Route::prefix('seller')->group(function () {
    Route::prefix('auth')->group(function () {
        // login
        Route::get('/login-as-seller', [AuthSellerController::class, 'viewLogin'])->name('seller.loginView');
        Route::post('/login', [AuthSellerController::class, 'login'])->name('seller.login');
        // logout
        Route::get('/logout', [AuthSellerController::class, 'logout'])->name('seller.logout');
    });

    Route::prefix('transaction')->group(function () {
        Route::post('/confirmation-order', [TransactionController::class, 'confirmOrder'])->name('seller.confirm.order');
        Route::post('/checkout', [TransactionController::class, 'checkoutSeller'])->name('seller.checkout');
    });

    Route::get('/', [PenjualController::class, 'index'])->name('seller.index');
    Route::post('/change-status', [PenjualController::class, 'changeStatus'])->name('seller.change.status');
    Route::get('/order', [PenjualController::class, 'indexOrder'])->name('seller.order');
    Route::get('/history', [PenjualController::class, 'history'])->name('seller.history');
    Route::get('/confirmation-order/{code}', [PenjualController::class, 'confirmOrder'])->name('seller.detail.order');
    Route::get('/detail-order/{code}', [PenjualController::class, 'detailOrder'])->name('seller.order.detail');
    Route::get('/cashier', [PenjualController::class, 'cashier'])->name('seller.cashier');
    Route::get('/get-products', [PenjualController::class, 'getProducts'])->name('seller.get.product');
});

Route::get('/download-invoice', [PdfController::class, 'exportInvoice'])->name('download.invoice');
