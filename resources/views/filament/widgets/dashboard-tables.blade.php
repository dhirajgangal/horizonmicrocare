@php
    $counts = $this->tabCounts();
@endphp

<x-filament-widgets::widget class="fi-wi-table admin-dashboard-tables">
    <div class="admin-dashboard-tables__card">
        <x-filament::tabs
            contained
            label="Dashboard records"
            class="admin-dashboard-tables__tabs"
        >
            <x-filament::tabs.item
                :active="$this->activeTab === 'applications'"
                :badge="$counts['applications']"
                wire:click="setActiveTab('applications')"
            >
                Applications
            </x-filament::tabs.item>

            <x-filament::tabs.item
                :active="$this->activeTab === 'inquiries'"
                :badge="$counts['inquiries']"
                wire:click="setActiveTab('inquiries')"
            >
                Inquiries
            </x-filament::tabs.item>

            <x-filament::tabs.item
                :active="$this->activeTab === 'products'"
                :badge="$counts['products']"
                wire:click="setActiveTab('products')"
            >
                Loan products
            </x-filament::tabs.item>
        </x-filament::tabs>

        {{ $this->table }}
    </div>
</x-filament-widgets::widget>
