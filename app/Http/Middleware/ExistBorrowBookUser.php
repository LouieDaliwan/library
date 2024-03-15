<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistBorrowBookUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->book->existUserBorrowBook((string) auth()->id()))
        {
            $authUser = auth()->user()->name;

            return response()->json([
                'message' => "{$authUser} already borrowed this {$request->book->title} LibraryBook"
            ], 422);
        }

        return $next($request);
    }
}
