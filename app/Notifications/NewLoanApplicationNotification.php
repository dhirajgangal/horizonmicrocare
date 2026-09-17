<?php

namespace App\Notifications;

use App\Models\LoanApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewLoanApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public LoanApplication $application)
    {
        $this->afterCommit();
    }

    /**
     * @return list<string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'loan_application',
            'title' => 'New loan application',
            'message' => $this->application->full_name.' submitted a loan application.',
            'url' => route('admin.loan-applications.show', $this->application),
        ];
    }
}
