<?php

namespace App\Http\Controllers;

use App\Actions\NotifyStaffOfSubmission;
use App\Enums\InquiryStatus;
use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;
use App\Support\Toast;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('pages.contact');
    }

    public function store(StoreInquiryRequest $request, NotifyStaffOfSubmission $notify): RedirectResponse
    {
        if (filled($request->input('website'))) {
            Toast::success('Thank you. Your enquiry has been received. We will respond if a reply is needed.');

            return redirect()->route('contact');
        }

        $inquiry = Inquiry::query()->create([
            ...$request->inquiryPayload(),
            'status' => InquiryStatus::New,
            'notes' => null,
        ]);

        $notify->inquiry($inquiry);

        Toast::success('Thank you. Your enquiry has been received. Sending this message does not guarantee a loan or approval.');

        return redirect()->route('contact');
    }
}
