<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // تحقق أن المستخدم مسجل دخول + دوره 'user' (أو ليس admin)
        if (auth()->check() && auth()->user()->role === 'user') {
            return $next($request);
        }

        return response()->json(['message' => 'هذه الصفحة مخصصة للعملاء فقط.'], 403);
    }
}
