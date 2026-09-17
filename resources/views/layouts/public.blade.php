@props([
    'title' => null,
    'breadcrumbs' => [],
    'lightbox' => false,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title.' · ' : '' }}{{ $site->seo_title ?: $site->organization_name }}</title>
    <meta name="description" content="{{ $site->seo_description }}">
    <link rel="icon" href="{{ asset('storage/images/logo-square.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    @if ($lightbox)
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    @endif
    @livewireStyles
</head>
<body class="min-h-screen bg-paper">
    @include('layouts.partials.header')

    <main>
        @if (count($breadcrumbs))
            @include('layouts.partials.breadcrumbs', ['items' => $breadcrumbs])
        @endif

        {{ $slot }}
    </main>

    @include('layouts.partials.footer')
    <x-toast />

    @livewireScripts
    @if ($lightbox)
        <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true });
            });
        </script>
    @endif
</body>
</html>
