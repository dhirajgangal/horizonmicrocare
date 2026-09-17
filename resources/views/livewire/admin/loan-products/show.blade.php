<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View product" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.loan-products.index')">Back</x-button>
            <x-button :href="route('admin.loan-products.edit', $loanProduct)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <dl class="grid gap-4">
            <div><dt class="text-xs uppercase text-text-2">Name</dt><dd class="font-semibold">{{ $loanProduct->name }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Short description</dt><dd>{{ $loanProduct->short_description }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Description</dt><dd class="whitespace-pre-line">{{ $loanProduct->description }}</dd></div>
            <div>
                <dt class="text-xs uppercase text-text-2">Features</dt>
                <dd>
                    <ul class="list-disc pl-5">
                        @foreach ($loanProduct->features ?? [] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </dd>
            </div>
            <div><dt class="text-xs uppercase text-text-2">Eligibility</dt><dd class="whitespace-pre-line">{{ $loanProduct->eligibility ?: '—' }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Documents</dt><dd class="whitespace-pre-line">{{ $loanProduct->required_documents ?: '—' }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <x-status-badge :tone="$loanProduct->is_active ? 'success' : 'muted'" :label="$loanProduct->is_active ? 'Active' : 'Hidden'" />
    </x-card>
</div>
