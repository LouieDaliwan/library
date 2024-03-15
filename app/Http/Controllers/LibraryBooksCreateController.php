<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryBooksRequest;
use App\Models\Library;
use Illuminate\Http\JsonResponse;

class LibraryBooksCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LibraryBooksRequest $request, Library $library) : JsonResponse
    {
        $libraryBook = $library->books()->firstOrCreate($request->validated());

        return response()->json([
            'data' => $libraryBook,
            'message' => 'LibraryBook has been added to the library successfully'
        ], 201);
    }
}
