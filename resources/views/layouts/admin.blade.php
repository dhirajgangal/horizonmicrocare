@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · {{ __('Super Admin') }}</title>
    <link rel="icon" href="{{ asset('storage/images/logo-square.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @livewireStyles
</head>
<body class="min-h-screen bg-paper">
    <div
        x-data="{
            collapsed: localStorage.getItem('adminSidebar') === '1',
            profileOpen: false,
            toggle() {
                this.collapsed = ! this.collapsed;
                localStorage.setItem('adminSidebar', this.collapsed ? '1' : '0');
            }
        }"
        class="flex min-h-screen"
    >
        @include('layouts.partials.admin-sidebar')

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="flex h-16 shrink-0 items-center justify-between border-b border-border bg-white px-4 md:px-8">
                <div class="flex min-w-0 items-center gap-3">
                    <x-icon-button
                        icon="bars-3"
                        :tooltip="__('Collapse menu')"
                        variant="navy"
                        x-on:click="toggle()"
                    />
                    <div class="min-w-0">
                        <p class="locale-caps text-[11px] text-text-2">{{ __('Super Admin') }}</p>
                        <p class="truncate text-sm font-semibold text-navy">{{ $title }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 md:gap-3">
                    <x-language-switcher />
                    @livewire('admin.notification-bell')
                    <div class="relative" x-on:click.outside="profileOpen = false">
                        <x-icon-button icon="user-circle" :tooltip="__('My profile')" x-on:click="profileOpen = ! profileOpen" />
                        <div
                            x-show="profileOpen"
                            x-cloak
                            class="absolute right-0 z-30 mt-2 w-64 rounded-xl border border-border bg-white p-4 shadow-lg"
                        >
                            <p class="font-semibold text-navy">{{ auth()->user()?->name }}</p>
                            <p class="mt-0.5 text-sm text-text-2">{{ auth()->user()?->email }}</p>
                            <a href="{{ route('admin.profile.edit') }}" class="mt-3 flex items-center gap-2 text-sm font-semibold text-navy hover:text-orange">
                                <x-ui-icon name="user-circle" class="h-4 w-4" />
                                {{ __('My profile') }}
                            </a>
                            <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 text-left text-sm font-semibold text-navy hover:text-orange">
                                    <x-ui-icon name="arrow-right-on-rectangle" class="h-4 w-4" />
                                    {{ __('Sign out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 p-4 md:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>

    <x-toast />
    @livewireScripts
</body>
</html>
