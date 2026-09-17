@php
    $groups = [
        __('Dashboard') => [
            ['route' => 'admin.dashboard', 'label' => __('Overview'), 'icon' => 'home', 'match' => 'admin.dashboard'],
        ],
        __('Website') => [
            ['route' => 'admin.home-slides.index', 'label' => __('Home slides'), 'icon' => 'photo', 'match' => 'admin.home-slides.*'],
            ['route' => 'admin.client-stories.index', 'label' => __('Client stories'), 'icon' => 'chat-bubble-left-right', 'match' => 'admin.client-stories.*'],
            ['route' => 'admin.gallery.index', 'label' => __('Gallery'), 'icon' => 'squares-2x2', 'match' => 'admin.gallery.*'],
            ['route' => 'admin.faqs.index', 'label' => __('FAQs'), 'icon' => 'question-mark-circle', 'match' => 'admin.faqs.*'],
            ['route' => 'admin.settings.edit', 'label' => __('Settings'), 'icon' => 'cog-6-tooth', 'match' => 'admin.settings.*'],
        ],
        __('Loans') => [
            ['route' => 'admin.loan-products.index', 'label' => __('Loan products'), 'icon' => 'banknotes', 'match' => 'admin.loan-products.*'],
            ['route' => 'admin.loan-applications.index', 'label' => __('Applications'), 'icon' => 'clipboard-document-list', 'match' => 'admin.loan-applications.*'],
        ],
        __('Customers') => [
            ['route' => 'admin.inquiries.index', 'label' => __('Inquiries'), 'icon' => 'envelope', 'match' => 'admin.inquiries.*'],
        ],
        __('Administration') => [
            ['route' => 'admin.users.index', 'label' => __('Admin users'), 'icon' => 'users', 'match' => 'admin.users.*'],
            ['route' => 'admin.profile.edit', 'label' => __('My profile'), 'icon' => 'user-circle', 'match' => 'admin.profile.*'],
        ],
    ];
@endphp

<aside
    class="admin-sidebar sticky top-5 flex h-screen shrink-0 flex-col bg-navy text-white"
    :class="collapsed ? 'w-20' : 'w-64'"
>
    <div class="shrink-0 bg-navy px-3 pt-4 pb-3 mt-2 mb-2">
        <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center justify-center rounded-btn bg-white px-2 py-2"
        >
            <img
                src="{{ asset('storage/images/logo-square.png') }}"
                alt=""
                class="h-8 w-8 object-contain"
                x-show="collapsed"
                x-cloak
            >
            <img
                src="{{ asset('storage/images/logo-rectangle.png') }}"
                alt="{{ $site->organization_name }}"
                class="h-10 w-auto max-w-full object-contain"
                x-show="! collapsed"
            >
        </a>
    </div>

    <nav class="flex-1 space-y-6 overflow-y-auto px-3 pt-2 pb-5">
        @foreach ($groups as $group => $items)
            <div>
                <p class="mt-1 px-2 text-xs font-semibold text-orange/90" x-show="! collapsed">{{ $group }}</p>
                <ul class="mt-2 space-y-1">
                    @foreach ($items as $item)
                        @php
                            $active = request()->routeIs($item['match']);
                        @endphp
                        <li>
                            <a
                                href="{{ route($item['route']) }}"
                                @class([
                                    'flex items-center gap-3 rounded-btn px-2.5 py-2 text-sm font-medium transition',
                                    'bg-orange font-semibold text-white' => $active,
                                    'text-white/80 hover:bg-white/10 hover:text-white' => ! $active,
                                ])
                            >
                                <x-ui-icon :name="$item['icon']" class="h-5 w-5 shrink-0" />
                                <span x-show="! collapsed" x-cloak>{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>
</aside>
