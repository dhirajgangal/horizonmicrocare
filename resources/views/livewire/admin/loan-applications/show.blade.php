<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View application" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.loan-applications.index')">Back</x-button>
            <x-button :href="route('admin.loan-applications.edit', $loanApplication)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <dl class="grid gap-4 md:grid-cols-2">
            <div><dt class="text-xs uppercase text-text-2">Name</dt><dd class="font-semibold">{{ $loanApplication->full_name }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Product</dt><dd>{{ $loanApplication->loanProduct?->name ?? '—' }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Amount requested</dt><dd>₹{{ number_format((float) $loanApplication->requested_amount, 2) }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Purpose</dt><dd>{{ $loanApplication->purpose }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Mobile</dt><dd>{{ $loanApplication->mobile }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Email</dt><dd>{{ $loanApplication->email }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Gender</dt><dd>{{ $loanApplication->gender }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Date of birth</dt><dd>{{ $loanApplication->date_of_birth->format('d M Y') }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Address</dt><dd>{{ $loanApplication->address }}, {{ $loanApplication->district }}, {{ $loanApplication->state }} {{ $loanApplication->pincode }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Occupation</dt><dd>{{ $loanApplication->occupation }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Monthly income</dt><dd>{{ $loanApplication->monthly_income ?: '—' }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Marital status</dt><dd>{{ $loanApplication->marital_status ?: '—' }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <x-status-badge :tone="$loanApplication->status->tone()" :label="$loanApplication->status->label()" />
        <p class="mt-4 whitespace-pre-line text-sm text-text-2">{{ $loanApplication->internal_notes ?: 'No internal notes.' }}</p>
    </x-card>
</div>
