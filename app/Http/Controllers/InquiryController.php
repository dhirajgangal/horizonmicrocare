<?php

namespace App\Http\Controllers;

use App\Enums\InquiryStatus;
use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        if (filled($request->input('website'))) {
            return redirect()
                ->route('contact')
                ->with('success', 'Thank you. We have received your enquiry and will respond using the details you provided. This does not guarantee a loan.');
        }

        Inquiry::query()->create([
            ...$request->safe()->only(['name', 'email', 'mobile', 'subject', 'message']),
            'status' => InquiryStatus::New,
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thank you. We have received your enquiry and will respond using the details you provided. This does not guarantee a loan.');
    }
}
