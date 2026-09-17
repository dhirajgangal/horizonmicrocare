<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading :title="__('View product')" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.loan-products.index')">{{ __('Back') }}</x-button>
            <x-button :href="route('admin.loan-products.edit', $loanProduct)">{{ __('Edit') }}</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Basic') }}</h3>
        <dl class="grid gap-4">
            <div><dt class="field-kicker">{{ __('Name') }}</dt><dd class="font-semibold">{{ $loanProduct->name }}</dd></div>
            <div><dt class="field-kicker">{{ __('Short description') }}</dt><dd>{{ $loanProduct->short_description }}</dd></div>
            <div><dt class="field-kicker">{{ __('Description') }}</dt><dd class="whitespace-pre-line">{{ $loanProduct->description }}</dd></div>
            <div>
                <dt class="field-kicker">{{ __('Features') }}</dt>
                <dd>
                    <ul class="list-disc pl-5">
                        @foreach ($loanProduct->features ?? [] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </dd>
            </div>
            <div><dt class="field-kicker">{{ __('Eligibility') }}</dt><dd class="whitespace-pre-line">{{ $loanProduct->eligibility ?: '—' }}</dd></div>
            <div><dt class="field-kicker">{{ __('Documents') }}</dt><dd class="whitespace-pre-line">{{ $loanProduct->required_documents ?: '—' }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">{{ __('Status') }}</h3>
        <x-status-badge :tone="$loanProduct->is_active ? 'success' : 'muted'" :label="$loanProduct->is_active ? __('Active') : __('Hidden')" />
    </x-card>
</div>
