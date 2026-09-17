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
    class="admin-sidebar sticky top-0 flex h-svh shrink-0 flex-col overflow-hidden bg-navy text-white"
    :class="collapsed ? 'is-collapsed w-20' : 'w-64'"
>
    <div class="admin-sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-logo">
            <img
                src="{{ asset('storage/images/logo-square.png') }}"
                alt=""
                class="admin-sidebar-logo-mark"
                x-show="collapsed"
                x-cloak
            >
            <img
                src="{{ asset('storage/images/logo-rectangle.png') }}"
                alt="{{ $site->organization_name }}"
                class="admin-sidebar-logo-wordmark"
                x-show="! collapsed"
                x-cloak
            >
        </a>
    </div>

    <nav class="admin-sidebar-nav">
        @foreach ($groups as $group => $items)
            <div class="admin-sidebar-group">
                <p class="admin-sidebar-group-title" x-show="! collapsed" x-cloak>{{ $group }}</p>
                <ul class="admin-sidebar-list">
                    @foreach ($items as $item)
                        @php
                            $active = request()->routeIs($item['match']);
                        @endphp
                        <li>
                            <a
                                href="{{ route($item['route']) }}"
                                title="{{ $item['label'] }}"
                                @class([
                                    'admin-sidebar-link',
                                    'is-active bg-orange' => $active,
                                ])
                            >
                                <x-ui-icon :name="$item['icon']" class="h-5 w-5 shrink-0" />
                                <span class="admin-sidebar-label" x-show="! collapsed" x-cloak>{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>
</aside>
