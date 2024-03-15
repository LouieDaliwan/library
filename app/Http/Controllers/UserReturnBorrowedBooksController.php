<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\LibraryBook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserReturnBorrowedBooksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library, LibraryBook $book): JsonResponse
    {
        $book->users()->detach(auth()->id());

        $book->increment('qty');

        $book->save();

        return response()->json([
            'message' => "{$book->title} return successfully"
        ], 201);
    }
}
