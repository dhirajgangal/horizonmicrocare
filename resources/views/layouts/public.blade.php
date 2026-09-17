<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.seo')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if ($site->get('branding.favicon'))
            <link rel="icon" href="{{ $site->logoUrl() === asset('storage/'.$site->get('branding.favicon')) ? $site->logoUrl() : asset('storage/'.$site->get('branding.favicon')) }}">
        @else
            <link rel="icon" href="{{ $site->logoUrl('square') }}">
        @endif
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @fonts
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700|source-serif-4:500,600,700" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('css/public-fallback.css') }}">
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
        @endif
        <link rel="stylesheet" href="{{ asset('css/theme-alerts.css') }}">
    </head>
    <body class="flex min-h-screen flex-col bg-background text-text-primary">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-accent focus:px-4 focus:py-2 focus:text-white">
            Skip to content
        </a>

        @include('layouts.partials.header')
        <x-flash-toasts />

        <main id="main-content" class="flex-1">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </body>
</html>
