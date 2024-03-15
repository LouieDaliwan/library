<?php

namespace App\Http\Controllers;

use App\Http\Resources\LibraryBooksResources;
use App\Models\Library;
use App\Models\LibraryBook;
use Illuminate\Http\Request;

class LibraryBookDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library, LibraryBook $book)
    {
        return new LibraryBooksResources($book);
    }
}
