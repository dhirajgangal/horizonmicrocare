<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, config('app.available_locales', ['gu', 'en']), true), 404);

        $request->session()->put('locale', $locale);

        return back()->cookie(cookie()->forever('locale', $locale));
    }
}
