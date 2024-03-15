<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library) : JsonResponse
    {
        $library->delete();

        return response()->json([
            'message' => 'Library deleted successfully'
        ], 202);
    }
}
