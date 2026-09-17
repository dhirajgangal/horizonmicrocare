<x-public-layout
    :title="__('FAQs')"
    :breadcrumbs="[['label' => __('FAQs')]]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ __('Frequently asked questions') }}</h1>
        </div>
    </section>
    <section class="mx-auto max-w-4xl px-4 py-16 md:px-6">
        <div class="space-y-3" x-data="{ open: 0 }">
            @foreach ($faqs as $index => $faq)
                <div class="rounded-xl border border-border bg-surface">
                    <button type="button" class="flex w-full items-center justify-between px-5 py-4 text-left font-semibold" @click="open = open === {{ $index }} ? null : {{ $index }}">
                        <span>
                            @if ($faq->category)
                                <span class="mb-1 block text-xs text-orange">{{ $faq->category }}</span>
                            @endif
                            {{ $faq->question }}
                        </span>
                        <x-ui-icon name="chevron-down" class="h-5 w-5 shrink-0 text-orange transition" x-bind:class="open === {{ $index }} ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open === {{ $index }}" x-cloak class="px-5 pb-5 text-text-2">{{ $faq->answer }}</div>
                </div>
            @endforeach
        </div>
    </section>
</x-public-layout>
