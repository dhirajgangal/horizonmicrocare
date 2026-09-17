<x-public-layout
    :title="$product->name"
    :breadcrumbs="[
        ['label' => __('Our offerings'), 'url' => route('offerings.index')],
        ['label' => $product->name],
    ]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ $product->name }}</h1>
            <p class="mt-4 max-w-2xl text-white/75">{{ $product->short_description }}</p>
            <div class="mt-8">
                <x-button :href="route('apply', ['product' => $product->id])">{{ __('Apply for Loan') }}</x-button>
            </div>
        </div>
    </section>
    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-16 lg:grid-cols-3 md:px-6">
        <div class="lg:col-span-2 space-y-8">
            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('About this offering') }}</h2>
                <p class="mt-4 whitespace-pre-line text-text-2">{{ $product->description }}</p>
            </x-card>
            @if ($product->features)
                <x-card>
                    <h2 class="font-serif text-2xl text-navy">{{ __('What to expect') }}</h2>
                    <ul class="mt-4 list-disc space-y-2 pl-5 text-text-2">
                        @foreach ($product->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </x-card>
            @endif
        </div>
        <div class="space-y-6">
            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Eligibility notes') }}</h2>
                <p class="mt-3 whitespace-pre-line text-sm text-text-2">{{ $product->eligibility ?: __('Eligibility is reviewed after we receive your application. This website does not decide a loan.') }}</p>
            </x-card>
            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Documents often requested') }}</h2>
                <p class="mt-3 whitespace-pre-line text-sm text-text-2">{{ $product->required_documents ?: __('We will tell you if anything else is needed after we review your form.') }}</p>
            </x-card>
        </div>
    </section>
</x-public-layout>
