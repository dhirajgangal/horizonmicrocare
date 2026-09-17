<?php

namespace App\Actions;

use App\Mail\NewInquiryMail;
use App\Mail\NewLoanApplicationMail;
use App\Models\Inquiry;
use App\Models\LoanApplication;
use App\Models\User;
use App\Notifications\NewInquiryNotification;
use App\Notifications\NewLoanApplicationNotification;
use App\Services\SiteSettings;
use Illuminate\Support\Facades\Mail;

class NotifyStaffOfSubmission
{
    public function __construct(private SiteSettings $settings) {}

    public function application(LoanApplication $application): void
    {
        Mail::to($this->settings->adminNotificationEmail())
            ->queue(new NewLoanApplicationMail($application));

        User::role('Super Admin')->each(function (User $user) use ($application): void {
            $user->notify(new NewLoanApplicationNotification($application));
        });
    }

    public function inquiry(Inquiry $inquiry): void
    {
        Mail::to($this->settings->adminNotificationEmail())
            ->queue(new NewInquiryMail($inquiry));

        User::role('Super Admin')->each(function (User $user) use ($inquiry): void {
            $user->notify(new NewInquiryNotification($inquiry));
        });
    }
}
