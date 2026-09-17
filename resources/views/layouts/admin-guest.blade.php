@props(['title' => 'Sign in'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · {{ __('Super Admin') }}</title>
    <link rel="icon" href="{{ asset('storage/images/logo-square.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    @livewireStyles
</head>
<body class="min-h-screen bg-paper">
    {{ $slot }}
    <x-toast />
    @livewireScripts
</body>
</html>
