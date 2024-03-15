<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryBooksDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library, $book): JsonResponse
    {
        $book = LibraryBook::withTrashed()->findOrFail($book);

        $book->forceDelete();

        return response()->json([
            'message' => 'LibraryBook has been deleted successfully'
        ], 200);
    }
}
