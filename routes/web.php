<?php

use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StoryController;
use App\Livewire\Admin\ClientStories;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Faqs;
use App\Livewire\Admin\GalleryImages;
use App\Livewire\Admin\HomeSlides;
use App\Livewire\Admin\Inquiries;
use App\Livewire\Admin\LoanApplications;
use App\Livewire\Admin\LoanProducts;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/our-mission', [PageController::class, 'mission'])->name('mission');
Route::get('/our-offerings', [OfferingController::class, 'index'])->name('offerings.index');
Route::get('/our-offerings/{loanProduct:slug}', [OfferingController::class, 'show'])->name('offerings.show');
Route::get('/client-stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/client-stories/{story:slug}', [StoryController::class, 'show'])->name('stories.show');
Route::get('/gallery', GalleryController::class)->name('gallery');
Route::get('/faqs', FaqController::class)->name('faqs');
Route::get('/apply-loan', [LoanApplicationController::class, 'create'])->name('apply');
Route::post('/apply-loan', [LoanApplicationController::class, 'store'])->middleware('throttle:5,1')->name('apply.store');
Route::get('/contact-us', [ContactController::class, 'create'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');
Route::get('/responsible-lending', [PageController::class, 'responsibleLending'])->name('responsible-lending');
Route::get('/locale/{locale}', LocaleController::class)->name('locale.switch');

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'store'])->middleware('throttle:5,1')->name('admin.login.store');
});

Route::middleware(['auth', 'role:Super Admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile\Form::class)->name('profile.edit');
    Route::get('/export/{module}/{format}', ExportController::class)->name('export');

    Route::get('/home-slides', HomeSlides\Index::class)->name('home-slides.index');
    Route::get('/home-slides/create', HomeSlides\Form::class)->name('home-slides.create');
    Route::get('/home-slides/{homeSlide}', HomeSlides\Show::class)->name('home-slides.show');
    Route::get('/home-slides/{homeSlide}/edit', HomeSlides\Form::class)->name('home-slides.edit');

    Route::get('/loan-products', LoanProducts\Index::class)->name('loan-products.index');
    Route::get('/loan-products/create', LoanProducts\Form::class)->name('loan-products.create');
    Route::get('/loan-products/{loanProduct}', LoanProducts\Show::class)->name('loan-products.show');
    Route::get('/loan-products/{loanProduct}/edit', LoanProducts\Form::class)->name('loan-products.edit');

    Route::get('/client-stories', ClientStories\Index::class)->name('client-stories.index');
    Route::get('/client-stories/create', ClientStories\Form::class)->name('client-stories.create');
    Route::get('/client-stories/{clientStory}', ClientStories\Show::class)->name('client-stories.show');
    Route::get('/client-stories/{clientStory}/edit', ClientStories\Form::class)->name('client-stories.edit');

    Route::get('/gallery', GalleryImages\Index::class)->name('gallery.index');
    Route::get('/gallery/create', GalleryImages\Form::class)->name('gallery.create');
    Route::get('/gallery/{galleryImage}', GalleryImages\Show::class)->name('gallery.show');
    Route::get('/gallery/{galleryImage}/edit', GalleryImages\Form::class)->name('gallery.edit');

    Route::get('/faqs', Faqs\Index::class)->name('faqs.index');
    Route::get('/faqs/create', Faqs\Form::class)->name('faqs.create');
    Route::get('/faqs/{faq}', Faqs\Show::class)->name('faqs.show');
    Route::get('/faqs/{faq}/edit', Faqs\Form::class)->name('faqs.edit');

    Route::get('/loan-applications', LoanApplications\Index::class)->name('loan-applications.index');
    Route::get('/loan-applications/{loanApplication}', LoanApplications\Show::class)->name('loan-applications.show');
    Route::get('/loan-applications/{loanApplication}/edit', LoanApplications\Form::class)->name('loan-applications.edit');

    Route::get('/inquiries', Inquiries\Index::class)->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', Inquiries\Show::class)->name('inquiries.show');
    Route::get('/inquiries/{inquiry}/edit', Inquiries\Form::class)->name('inquiries.edit');

    Route::get('/settings', Settings\Form::class)->name('settings.edit');

    Route::get('/users', Users\Index::class)->name('users.index');
    Route::get('/users/create', Users\Form::class)->name('users.create');
    Route::get('/users/{user}', Users\Show::class)->name('users.show');
    Route::get('/users/{user}/edit', Users\Form::class)->name('users.edit');
});
