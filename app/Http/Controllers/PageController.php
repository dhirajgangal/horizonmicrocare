<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function mission(): View
    {
        return view('pages.mission');
    }

    public function privacy(): View
    {
        return view('pages.legal', [
            'title' => 'Privacy Policy',
            'heading' => 'Privacy Policy',
            'partial' => 'pages.legal.privacy',
        ]);
    }

    public function terms(): View
    {
        return view('pages.legal', [
            'title' => 'Terms of Use',
            'heading' => 'Terms of Use',
            'partial' => 'pages.legal.terms',
        ]);
    }

    public function disclaimer(): View
    {
        return view('pages.legal', [
            'title' => 'Disclaimer',
            'heading' => 'Disclaimer',
            'partial' => 'pages.legal.disclaimer',
        ]);
    }

    public function responsibleLending(): View
    {
        return view('pages.legal', [
            'title' => 'Responsible Lending',
            'heading' => 'Responsible Lending',
            'partial' => 'pages.legal.responsible-lending',
        ]);
    }
}
