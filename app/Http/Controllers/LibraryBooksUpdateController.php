<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryBooksRequest;
use App\Models\LibraryBook;
use App\Models\Library;
use Illuminate\Http\JsonResponse;


class LibraryBooksUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LibraryBooksRequest $request, Library $library, LibraryBook $book) : JsonResponse
    {
        $book->update($request->validated());

        return response()->json([
            'data' => $book,
            'message' => 'LibraryBook has been updated successfully'
        ], 200);
    }
}
