<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $library) : JsonResponse
    {
        $library = Library::withTrashed()->findOrFail($request->library);

        $library->forceDelete();

        return response()->json([
            'message' => 'Library has been deleted successfully'
        ], 202);
    }
}
