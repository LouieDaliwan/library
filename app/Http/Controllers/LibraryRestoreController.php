<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryRestoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $library) : JsonResponse
    {
        Library::withTrashed()->find($library)->restore();

        return response()->json([
            'message' => 'Library has been restored successfully'
        ], 202);
    }
}
