<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\LibraryBook;
use Illuminate\Http\Request;

class LibraryBooksRestoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library, $book)
    {
        LibraryBook::withTrashed()->find($book)->restore();

        return response()->json([
            'message' => 'Library Book has been restored successfully'
        ], 202);
    }
}
