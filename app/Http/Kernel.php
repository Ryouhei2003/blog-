php

protected $routeMiddleware = [
    // 他のミドルウェア
    'auth.redirect' => \App\Http\Middleware\RedirectIfUnauthenticatedWithUrl::class,
];
