<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
use App\Models\Library;
use Illuminate\Http\JsonResponse;

class LibraryCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LibraryRequest $request) : JsonResponse
    {
        return response()->json(Library::firstOrCreate($request->validated()), 201);
    }
}
