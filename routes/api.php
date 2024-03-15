<?php

use App\Http\Controllers\LibraryBooksIndexController;
use App\Http\Controllers\LibraryIndexController;

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('libraries', LibraryIndexController::class);

    Route::get('libraries/{library}/books', LibraryBooksIndexController::class);

    Route::middleware(['auth.superadmin'])->group(function() {
        //libraries
        require(__DIR__.'/librarybooks/library.php');

        //library books
        require(__DIR__.'/librarybooks/book.php');
    });


    Route::middleware(['auth.member', 'check.library.book', 'exist.borrow.book.user', 'check.library.book.qty'])->group(function() {
        require(__DIR__.'/userbooks/book.php');
    });
});
