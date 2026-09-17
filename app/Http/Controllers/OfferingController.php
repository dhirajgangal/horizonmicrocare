<?php

namespace App\Http\Controllers;

use App\Models\LoanProduct;
use Illuminate\View\View;

class OfferingController extends Controller
{
    public function index(): View
    {
        return view('pages.offerings', [
            'products' => LoanProduct::query()->active()->get(),
        ]);
    }

    public function show(LoanProduct $loanProduct): View
    {
        abort_unless($loanProduct->is_active, 404);

        return view('pages.offering-show', [
            'product' => $loanProduct,
        ]);
    }
}
