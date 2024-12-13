<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUnauthenticatedWithUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next): Response
    {
        if (!Auth::check()) {
            // 未ログイン時に現在のURLをセッションに保存
            session(['url.intended' => $request->url()]);
            return redirect()->route('login');
        }

        return $next($request);
    }
}
