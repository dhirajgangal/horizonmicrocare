<x-public-layout
    :title="__('Our offerings')"
    :breadcrumbs="[['label' => __('Our offerings')]]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ __('Our offerings') }}</h1>
            <p class="mt-4 max-w-2xl text-white/75">{{ __('These are livelihood-oriented products you can enquire about. Details here are informational. Applying does not guarantee a loan or approval.') }}</p>
        </div>
    </section>
    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6">
        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($products as $product)
                <x-card class="flex flex-col">
                    <h2 class="font-serif text-2xl text-navy">{{ $product->name }}</h2>
                    <p class="mt-3 flex-1 text-text-2">{{ $product->short_description }}</p>
                    <div class="mt-6 flex gap-3">
                        <x-button :href="route('apply', ['product' => $product->id])">{{ __('Apply for Loan') }}</x-button>
                        <x-button variant="secondary" :href="route('offerings.show', $product)">{{ __('Learn more') }}</x-button>
                    </div>
                </x-card>
            @empty
                <p class="text-text-2">{{ __('No offerings are published at the moment.') }}</p>
            @endforelse
        </div>
    </section>
</x-public-layout>
