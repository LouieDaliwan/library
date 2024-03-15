<?php


use App\Http\Controllers\LibraryBookDetailsController;
use App\Http\Controllers\LibraryBooksCreateController;
use App\Http\Controllers\LibraryBooksDeleteController;
use App\Http\Controllers\LibraryBooksDestroyController;
use App\Http\Controllers\LibraryBooksRestoreController;
use App\Http\Controllers\LibraryBooksUpdateController;
use Illuminate\Support\Facades\Route;

Route::post('libraries/{library}/books', LibraryBooksCreateController::class);
Route::get('libraries/{library}/books', LibraryBookDetailsController::class);
Route::put('libraries/{library}/books/{book}', LibraryBooksUpdateController::class);
Route::put('libraries/{library}/books/{book}/restore', LibraryBooksRestoreController::class);
Route::delete('libraries/{library}/books/{book}/delete', LibraryBooksDeleteController::class);
Route::delete('libraries/{library}/books/{book}/destroy', LibraryBooksDestroyController::class);

