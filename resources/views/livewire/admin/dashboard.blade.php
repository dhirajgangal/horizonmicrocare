<div class="space-y-8">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ([
            ['label' => __('Loan products'), 'value' => $productCount, 'href' => route('admin.loan-products.index')],
            ['label' => __('Applications'), 'value' => array_sum($applicationCounts), 'href' => route('admin.loan-applications.index')],
            ['label' => __('Inquiries'), 'value' => $inquiryCount, 'href' => route('admin.inquiries.index')],
            ['label' => __('Stories'), 'value' => $storyCount, 'href' => route('admin.client-stories.index')],
            ['label' => __('Gallery'), 'value' => $galleryCount, 'href' => route('admin.gallery.index')],
        ] as $stat)
            <a href="{{ $stat['href'] }}" class="rounded-xl border border-border bg-white p-5 shadow-sm transition hover:border-orange">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-text-2">{{ $stat['label'] }}</p>
                <p class="mt-2 font-serif text-3xl text-navy">{{ $stat['value'] }}</p>
            </a>
        @endforeach
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <x-card>
            <h2 class="font-serif text-xl text-navy">{{ __('Applications by status') }}</h2>
            @if (array_sum($chartStatus['values']) > 0)
                <div
                    class="mt-4"
                    x-data
                    x-init="
                        new ApexCharts($refs.statusChart, {
                            chart: { type: 'donut', height: 280, fontFamily: 'Source Sans 3, sans-serif' },
                            labels: {{ Illuminate\Support\Js::from($chartStatus['labels']) }},
                            series: {{ Illuminate\Support\Js::from($chartStatus['values']) }},
                            colors: ['#0B1F4A', '#F15A24', '#C47B17', '#B42318', '#5C6570'],
                            legend: { position: 'bottom' },
                            stroke: { colors: ['#FFFFFF'] },
                            dataLabels: { enabled: false },
                        }).render()
                    "
                >
                    <div x-ref="statusChart"></div>
                </div>
            @else
                <p class="mt-8 text-center text-sm text-text-2">{{ __('No chart data yet.') }}</p>
            @endif
        </x-card>

        <x-card class="xl:col-span-2">
            <h2 class="font-serif text-xl text-navy">{{ __('Applications and inquiries') }}</h2>
            <p class="mt-1 text-sm text-text-2">{{ __('Last 14 days') }}</p>
            <div
                class="mt-4"
                x-data
                x-init="
                    new ApexCharts($refs.trendChart, {
                        chart: { type: 'area', height: 280, toolbar: { show: false }, fontFamily: 'Source Sans 3, sans-serif' },
                        series: [
                            { name: {{ Illuminate\Support\Js::from(__('Applications')) }}, data: {{ Illuminate\Support\Js::from($chartTrend['applications']) }} },
                            { name: {{ Illuminate\Support\Js::from(__('Inquiries')) }}, data: {{ Illuminate\Support\Js::from($chartTrend['inquiries']) }} },
                        ],
                        colors: ['#0B1F4A', '#F15A24'],
                        stroke: { curve: 'smooth', width: 3 },
                        fill: { type: 'gradient', gradient: { opacityFrom: 0.35, opacityTo: 0.05 } },
                        dataLabels: { enabled: false },
                        xaxis: { categories: {{ Illuminate\Support\Js::from($chartTrend['labels']) }}, labels: { rotate: 0 } },
                        yaxis: { min: 0, forceNiceScale: true },
                        grid: { borderColor: '#E4E0DA' },
                    }).render()
                "
            >
                <div x-ref="trendChart"></div>
            </div>
        </x-card>
    </div>

    <x-card>
        <h2 class="font-serif text-xl text-navy">{{ __('Content snapshot') }}</h2>
        <div
            class="mt-4"
            x-data
            x-init="
                new ApexCharts($refs.contentChart, {
                    chart: { type: 'bar', height: 220, toolbar: { show: false }, fontFamily: 'Source Sans 3, sans-serif' },
                    series: [{ name: {{ Illuminate\Support\Js::from(__('Content snapshot')) }}, data: {{ Illuminate\Support\Js::from($chartContent['values']) }} }],
                    colors: ['#F15A24'],
                    plotOptions: { bar: { borderRadius: 8, columnWidth: '42%' } },
                    dataLabels: { enabled: false },
                    xaxis: { categories: {{ Illuminate\Support\Js::from($chartContent['labels']) }} },
                    yaxis: { min: 0, forceNiceScale: true },
                    grid: { borderColor: '#E4E0DA' },
                }).render()
            "
        >
            <div x-ref="contentChart"></div>
        </div>
    </x-card>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        @foreach ($applicationCounts as $status => $count)
            <x-card>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-text-2">{{ \App\Enums\ApplicationStatus::from($status)->label() }}</p>
                <p class="mt-2 font-serif text-2xl text-navy">{{ $count }}</p>
            </x-card>
        @endforeach
        <x-card>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-text-2">{{ __('New inquiries') }}</p>
            <p class="mt-2 font-serif text-2xl text-navy">{{ $newInquiries }}</p>
        </x-card>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <x-card :padding="false">
            <div class="flex items-center justify-between border-b border-border px-6 py-4">
                <h2 class="font-serif text-xl text-navy">{{ __('Recent applications') }}</h2>
                <x-button variant="ghost" :href="route('admin.loan-applications.index')">{{ __('View all') }}</x-button>
            </div>
            <div class="divide-y divide-border">
                @forelse ($recentApplications as $application)
                    <a href="{{ route('admin.loan-applications.index', ['modal' => 'view', 'modalId' => $application->id]) }}" class="flex items-center justify-between px-6 py-4 hover:bg-paper">
                        <div>
                            <p class="font-semibold text-navy">{{ $application->full_name }}</p>
                            <p class="text-sm text-text-2">{{ $application->loanProduct?->name ?? 'General' }}</p>
                        </div>
                        <x-status-badge :tone="$application->status->tone()" :label="$application->status->label()" />
                    </a>
                @empty
                    <p class="px-6 py-10 text-center text-sm text-text-2">{{ __('No applications yet.') }}</p>
                @endforelse
            </div>
        </x-card>

        <x-card :padding="false">
            <div class="flex items-center justify-between border-b border-border px-6 py-4">
                <h2 class="font-serif text-xl text-navy">{{ __('Recent inquiries') }}</h2>
                <x-button variant="ghost" :href="route('admin.inquiries.index')">{{ __('View all') }}</x-button>
            </div>
            <div class="divide-y divide-border">
                @forelse ($recentInquiries as $inquiry)
                    <a href="{{ route('admin.inquiries.index', ['modal' => 'view', 'modalId' => $inquiry->id]) }}" class="flex items-center justify-between px-6 py-4 hover:bg-paper">
                        <div>
                            <p class="font-semibold text-navy">{{ $inquiry->name }}</p>
                            <p class="text-sm text-text-2">{{ $inquiry->subject }}</p>
                        </div>
                        <x-status-badge :tone="$inquiry->status->tone()" :label="$inquiry->status->label()" />
                    </a>
                @empty
                    <p class="px-6 py-10 text-center text-sm text-text-2">{{ __('No inquiries yet.') }}</p>
                @endforelse
            </div>
        </x-card>
    </div>

    <div class="flex flex-wrap gap-3">
        <x-button :href="route('admin.loan-products.index', ['modal' => 'create'])">{{ __('Add product') }}</x-button>
        <x-button variant="secondary" :href="route('admin.home-slides.index', ['modal' => 'create'])">{{ __('Add slide') }}</x-button>
        <x-button variant="secondary" :href="route('admin.settings.edit')">{{ __('Settings') }}</x-button>
    </div>
</div>
