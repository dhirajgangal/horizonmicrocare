<?php

namespace App\Http\Controllers;

use App\Actions\NotifyStaffOfSubmission;
use App\Enums\ApplicationStatus;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\LoanApplication;
use App\Models\LoanProduct;
use App\Support\IndianStates;
use App\Support\Toast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanApplicationController extends Controller
{
    public function create(Request $request): View
    {
        return view('pages.apply', [
            'products' => LoanProduct::query()->active()->get(),
            'states' => IndianStates::names(),
            'selectedProductId' => $request->integer('product'),
        ]);
    }

    public function store(StoreApplicationRequest $request, NotifyStaffOfSubmission $notify): RedirectResponse
    {
        if (filled($request->input('website'))) {
            Toast::success('Thank you. We have received your application and will be in touch if we need more information.');

            return redirect()->route('apply');
        }

        $application = LoanApplication::query()->create([
            ...$request->applicationPayload(),
            'status' => ApplicationStatus::New,
            'internal_notes' => null,
        ]);

        $notify->application($application);

        Toast::success('Thank you. We have received your application and will be in touch if we need more information. Submitting this form does not guarantee a loan or approval.');

        return redirect()->route('apply');
    }
}
