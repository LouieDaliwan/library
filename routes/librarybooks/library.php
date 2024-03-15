<?php
use App\Http\Controllers\LibraryDeleteController;
use App\Http\Controllers\LibraryDestroyController;
use App\Http\Controllers\LibraryRestoreController;
use App\Http\Controllers\LibraryUpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryCreateController;



Route::post('libraries', LibraryCreateController::class);
Route::put('libraries/{library}', LibraryUpdateController::class);
Route::put('libraries/{library}/restore', LibraryRestoreController::class);
Route::delete('libraries/{library}/delete', LibraryDeleteController::class);
Route::delete('libraries/{library}/destroy', LibraryDestroyController::class);
