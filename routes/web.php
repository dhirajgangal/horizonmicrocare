<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/contact-us', [InquiryController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('inquiries.store');

Route::controller(PageController::class)->group(function (): void {
    Route::get('/about-us', 'about')->name('about');
    Route::get('/our-mission', 'mission')->name('mission');
    Route::get('/loans', 'loans')->name('loans.index');
    Route::get('/loans/{slug}', 'loan')->name('loans.show');
    Route::get('/how-it-works', 'howItWorks')->name('how-it-works');
    Route::get('/loan-eligibility', 'eligibility')->name('eligibility');
    Route::get('/responsible-lending', 'responsibleLending')->name('responsible-lending');
    Route::get('/client-stories', 'stories')->name('stories.index');
    Route::get('/client-stories/{slug}', 'story')->name('stories.show');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/apply-loan', 'apply')->name('apply');
    Route::get('/track-application', 'track')->name('track');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::get('/grievance', 'grievance')->name('grievance');
    Route::get('/careers', 'careers')->name('careers');
    Route::get('/news', 'news')->name('news');
    Route::get('/resources', 'resources')->name('resources');
    Route::get('/privacy-policy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/disclaimer', 'disclaimer')->name('disclaimer');
});
