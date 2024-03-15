<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLibraryBookQty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->book->qty === 0) {
            return response()->json([
                'message' => "{$request->book->title} is unavailable to borrow / out of stock."
            ], 422);
        }

        return $next($request);
    }
}
