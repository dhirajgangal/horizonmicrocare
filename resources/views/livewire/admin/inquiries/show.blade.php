<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading :title="__('View enquiry')" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.inquiries.index')">{{ __('Back') }}</x-button>
            <x-button :href="route('admin.inquiries.edit', $inquiry)">{{ __('Edit') }}</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
        <dl class="grid gap-4 md:grid-cols-2">
            <div><dt class="field-kicker">{{ __('Name') }}</dt><dd class="font-semibold">{{ $inquiry->name }}</dd></div>
            <div><dt class="field-kicker">{{ __('Subject') }}</dt><dd>{{ $inquiry->subject }}</dd></div>
            <div><dt class="field-kicker">{{ __('Email') }}</dt><dd>{{ $inquiry->email }}</dd></div>
            <div><dt class="field-kicker">{{ __('Mobile') }}</dt><dd>{{ $inquiry->mobile }}</dd></div>
            <div class="md:col-span-2"><dt class="field-kicker">{{ __('Message') }}</dt><dd class="whitespace-pre-line">{{ $inquiry->message }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
        <x-status-badge :tone="$inquiry->status->tone()" :label="$inquiry->status->label()" />
        <p class="mt-4 whitespace-pre-line text-sm text-text-2">{{ $inquiry->notes ?: __('No notes.') }}</p>
    </x-card>
</div>
