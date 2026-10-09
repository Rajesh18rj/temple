<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptDetailController;
use App\Http\Controllers\RegisterReceiptController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('register-receipts.create');
})->name('welcome');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    // Receipt
    Route::get('/receipts', [ReceiptController::class, 'index'])
        ->name('receipts.index');

    Route::get('/receipts/create', [ReceiptController::class, 'create'])
        ->name('receipts.create');

    Route::post('/receipts', [ReceiptController::class, 'store'])
        ->name('receipts.store');

    Route::get('/receipts/{receipt}/edit', [ReceiptController::class, 'edit'])
        ->name('receipts.edit');

    Route::put('/receipts/{receipt}', [ReceiptController::class, 'update'])
        ->name('receipts.update');

    Route::delete('/receipts/{receipt}', [ReceiptController::class, 'destroy'])
        ->name('receipts.destroy');

    Route::get('/receipts/{receipt}/details', [ReceiptDetailController::class, 'create'])
        ->name('receipts.details');

    Route::post('/receipts/{receipt}/details', [ReceiptDetailController::class, 'store'])
        ->name('receipts.details.store');

    Route::get('/receipts/{receipt}/view', [ReceiptDetailController::class, 'show'])
        ->name('receipts.view');

    Route::get('/receipts/{receipt}/download-pdf',
        [ReceiptController::class, 'downloadPdf']
    )->name('receipts.download-pdf');

    Route::get(
        '/receipts/export/all',
        [ReceiptController::class, 'downloadAllExcel']
    )->name('receipts.export.all');

    Route::get(
        '/receipts/export',
        [ReceiptController::class, 'downloadExcel']
    )->name('receipts.export');


});

Route::get('/register-receipt', [RegisterReceiptController::class, 'create'])
    ->name('register-receipts.create');

Route::post('/register-receipt', [RegisterReceiptController::class, 'store'])
    ->name('register-receipts.store');

Route::get('/register-receipt/payment/{receipt}', [RegisterReceiptController::class, 'payment'])
    ->name('register-receipts.payment');

Route::post('/register-receipt/payment/{receipt}', [RegisterReceiptController::class, 'paymentStore'])
    ->name('register-receipts.payment.store');

Route::get('/register-receipt/success/{receipt}', [RegisterReceiptController::class, 'success'])
    ->name('register-receipts.success');

Route::post(
    '/register-receipts/cities',
    [RegisterReceiptController::class, 'storeCity']
)->name('register-receipts.cities.store');
require __DIR__.'/auth.php';
