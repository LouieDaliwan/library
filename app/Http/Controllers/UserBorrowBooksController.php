<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserBorrowBooksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library, LibraryBook $book): JsonResponse
    {
        $book->users()->attach(auth()->id());

        $book->decrement('qty');

        $book->save();

        return response()->json([
            'message' => "{$book->title} borrowed successfully"
        ], 201);
    }
}
