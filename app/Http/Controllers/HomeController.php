<?php

namespace App\Http\Controllers;

use App\Models\ClientStory;
use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\HomeSlide;
use App\Models\LoanProduct;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'slides' => HomeSlide::query()->active()->get(),
            'products' => LoanProduct::query()->active()->get(),
            'stories' => ClientStory::query()->published()->limit(6)->get(),
            'galleryImages' => GalleryImage::query()->active()->limit(10)->get(),
            'faqs' => Faq::query()->active()->featured()->limit(8)->get(),
        ]);
    }
}
