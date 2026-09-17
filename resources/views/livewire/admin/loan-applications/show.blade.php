<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading :title="__('View application')" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.loan-applications.index')">{{ __('Back') }}</x-button>
            <x-button :href="route('admin.loan-applications.edit', $loanApplication)">{{ __('Edit') }}</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
        <dl class="grid gap-4 md:grid-cols-2">
            <div><dt class="field-kicker">{{ __('Name') }}</dt><dd class="font-semibold">{{ $loanApplication->full_name }}</dd></div>
            <div><dt class="field-kicker">{{ __('Product') }}</dt><dd>{{ $loanApplication->loanProduct?->name ?? '—' }}</dd></div>
            <div><dt class="field-kicker">{{ __('Amount requested') }}</dt><dd>₹{{ number_format((float) $loanApplication->requested_amount, 2) }}</dd></div>
            <div><dt class="field-kicker">{{ __('Purpose') }}</dt><dd>{{ $loanApplication->purpose }}</dd></div>
            <div><dt class="field-kicker">{{ __('Mobile') }}</dt><dd>{{ $loanApplication->mobile }}</dd></div>
            <div><dt class="field-kicker">{{ __('Email') }}</dt><dd>{{ $loanApplication->email }}</dd></div>
            <div><dt class="field-kicker">{{ __('Gender') }}</dt><dd>{{ $loanApplication->gender }}</dd></div>
            <div><dt class="field-kicker">{{ __('Date of birth') }}</dt><dd>{{ $loanApplication->date_of_birth->format('d M Y') }}</dd></div>
            <div><dt class="field-kicker">{{ __('Address') }}</dt><dd>{{ $loanApplication->address }}, {{ $loanApplication->district }}, {{ $loanApplication->state }} {{ $loanApplication->pincode }}</dd></div>
            <div><dt class="field-kicker">{{ __('Occupation') }}</dt><dd>{{ $loanApplication->occupation }}</dd></div>
            <div><dt class="field-kicker">{{ __('Monthly income') }}</dt><dd>{{ $loanApplication->monthly_income ?: '—' }}</dd></div>
            <div><dt class="field-kicker">{{ __('Marital status') }}</dt><dd>{{ $loanApplication->marital_status ?: '—' }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
        <x-status-badge :tone="$loanApplication->status->tone()" :label="$loanApplication->status->label()" />
        <p class="mt-4 whitespace-pre-line text-sm text-text-2">{{ $loanApplication->internal_notes ?: __('No internal notes.') }}</p>
    </x-card>
</div>
