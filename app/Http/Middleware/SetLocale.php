<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $available = config('app.available_locales', ['gu', 'en']);
        $locale = $request->session()->get('locale', $request->cookie('locale', config('app.locale')));

        if (is_string($locale) && in_array($locale, $available, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
