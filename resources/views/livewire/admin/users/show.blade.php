<div class="space-y-6">
    <div @class(['flex items-center justify-between', 'hidden' => $embedded])>
        <x-section-heading title="View user" />
        <div class="flex gap-3">
            <x-button variant="secondary" :href="route('admin.users.index')">Back</x-button>
            <x-button :href="route('admin.users.edit', $user)">Edit</x-button>
        </div>
    </div>
    <x-card>
        <h3 class="mb-4 font-serif text-xl text-navy">Basic</h3>
        <p class="font-semibold">{{ $user->name }}</p>
        <p class="text-text-2">{{ $user->email }}</p>
        <p class="mt-3 text-sm">Roles: {{ $user->getRoleNames()->join(', ') ?: '—' }}</p>
    </x-card>
</div>
