<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;

Route::get('/receipt/{id}', [ReceiptController::class, 'getReceipt']);
