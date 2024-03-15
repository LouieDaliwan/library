<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLibraryBook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $book = $request->book->id ?? $request->book;

        $checkExists = $request->library->books()->whereId($book)->exists();

        if (!$checkExists) {
            return abort(404, 'Book not found');
        }
        return $next($request);
    }
}
