<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->method(), ['PUT', 'POST', 'PATCH'])) {

            if ($request->header('Content-Type') !== 'application/json') {
                return response()->json([
                    'error' => [
                        'http_code' => 415,
                        'message' => 'The Content-Type header must always be application/json',
                    ]
                ], 415);
            }
        }

        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
