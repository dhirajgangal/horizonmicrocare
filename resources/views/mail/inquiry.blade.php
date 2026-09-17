<x-mail::message>
# New enquiry

{{ $inquiry->name }} sent a message through the contact form.

**Subject:** {{ $inquiry->subject }}  
**Mobile:** {{ $inquiry->mobile }}  
**Email:** {{ $inquiry->email }}

{{ $inquiry->message }}

<x-mail::button :url="route('admin.inquiries.show', $inquiry)">
Review enquiry
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
