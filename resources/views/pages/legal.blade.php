<x-public-layout
    :title="$title"
    :breadcrumbs="[['label' => $heading]]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ $heading }}</h1>
        </div>
    </section>
    <section class="mx-auto max-w-3xl px-4 py-16 md:px-6">
        <x-card class="prose prose-navy max-w-none">
            @include($partial)
        </x-card>
    </section>
</x-public-layout>
