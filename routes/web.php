<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;

Route::get('/print-receipt/{id}', [ReceiptController::class, 'showPrintPage']);
Route::get('/receipt/{id}', [ReceiptController::class, 'getReceipt']);