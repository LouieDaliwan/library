<?php

namespace App\Http\Controllers;

use App\Http\Resources\LibraryBooksResources;
use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LibraryBooksIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Library $library): AnonymousResourceCollection
    {
        return LibraryBooksResources::collection($library->books()->paginate(10));
    }
}
