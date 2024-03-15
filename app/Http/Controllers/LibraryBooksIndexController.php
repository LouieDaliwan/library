<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryBooksIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library): JsonResponse
    {
        return response()->json([
            'data' => $library->books()->paginate(10)
        ]);
    }
}
