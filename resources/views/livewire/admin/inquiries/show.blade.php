<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View enquiry" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.inquiries.index')">Back</x-button>
            <x-button :href="route('admin.inquiries.edit', $inquiry)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <dl class="grid gap-4 md:grid-cols-2">
            <div><dt class="text-xs uppercase text-text-2">Name</dt><dd class="font-semibold">{{ $inquiry->name }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Subject</dt><dd>{{ $inquiry->subject }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Email</dt><dd>{{ $inquiry->email }}</dd></div>
            <div><dt class="text-xs uppercase text-text-2">Mobile</dt><dd>{{ $inquiry->mobile }}</dd></div>
            <div class="md:col-span-2"><dt class="text-xs uppercase text-text-2">Message</dt><dd class="whitespace-pre-line">{{ $inquiry->message }}</dd></div>
        </dl>
    </x-card>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Status</h3>
        <x-status-badge :tone="$inquiry->status->tone()" :label="$inquiry->status->label()" />
        <p class="mt-4 whitespace-pre-line text-sm text-text-2">{{ $inquiry->notes ?: 'No notes.' }}</p>
    </x-card>
</div>
