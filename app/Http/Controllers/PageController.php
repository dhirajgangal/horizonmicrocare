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
            'title' => __('Privacy policy'),
            'heading' => __('Privacy policy'),
            'partial' => 'pages.legal.privacy',
        ]);
    }

    public function terms(): View
    {
        return view('pages.legal', [
            'title' => __('Terms of use'),
            'heading' => __('Terms of use'),
            'partial' => 'pages.legal.terms',
        ]);
    }

    public function disclaimer(): View
    {
        return view('pages.legal', [
            'title' => __('Disclaimer'),
            'heading' => __('Disclaimer'),
            'partial' => 'pages.legal.disclaimer',
        ]);
    }

    public function responsibleLending(): View
    {
        return view('pages.legal', [
            'title' => __('Responsible lending'),
            'heading' => __('Responsible lending'),
            'partial' => 'pages.legal.responsible-lending',
        ]);
    }
}
