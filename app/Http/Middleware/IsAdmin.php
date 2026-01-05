<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // تحقق أن المستخدم مسجل دخول + دوره 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // إذا لم يكن أدمن، أرجع خطأ 403 (ممنوع)
        return response()->json(['message' => 'غير مصرح لك بالدخول، هذه المنطقة للمدراء فقط.'], 403);
    }
}
