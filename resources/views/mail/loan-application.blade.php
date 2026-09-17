<x-mail::message>
# New loan application

{{ $application->full_name }} submitted a loan application. This is an information request only — the website does not approve or disburse loans.

**Product:** {{ $application->loanProduct?->name ?? 'Not specified' }}  
**Requested amount:** ₹{{ number_format((float) $application->requested_amount, 2) }}  
**Purpose:** {{ $application->purpose }}  
**Mobile:** {{ $application->mobile }}  
**Email:** {{ $application->email }}

<x-mail::button :url="route('admin.loan-applications.show', $application)">
Review application
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
