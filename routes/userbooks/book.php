<?php

use App\Http\Controllers\UserBorrowBooksController;
use Illuminate\Support\Facades\Route;

Route::post('libraries/{library}/books/{book}/borrow', UserBorrowBooksController::class);
