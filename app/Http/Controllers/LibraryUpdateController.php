<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
use App\Models\Library;
use Illuminate\Http\JsonResponse;


class LibraryUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LibraryRequest $request, Library $library): JsonResponse
    {
        $library->update($request->validated());

        return response()->json($library, 200);
    }
}
