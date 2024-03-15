<?php

use App\Http\Controllers\UserBorrowBooksController;
use App\Http\Controllers\UserReturnBorrowedBooksController;
use Illuminate\Support\Facades\Route;

Route::middleware(['check.library.book', 'exist.borrow.book.user', 'check.library.book.qty'])->group(function() {
    Route::post('libraries/{library}/books/{book}/borrow', UserBorrowBooksController::class);
});

Route::middleware(['check.library.book'])->group(function() {
    Route::put('libraries/{library}/books/{book}/return', UserReturnBorrowedBooksController::class);
});

