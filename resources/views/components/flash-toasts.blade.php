@php
    $flash = match (true) {
        session()->has('success') => ['success', session('success')],
        session()->has('status') => ['success', session('status')],
        session()->has('error') => ['danger', session('error')],
        session()->has('warning') => ['warning', session('warning')],
        session()->has('info') => ['info', session('info')],
        default => null,
    };
@endphp

@if ($flash)
    <div
        class="theme-toast-stack"
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition.opacity
        role="status"
    >
        <div class="theme-toast theme-toast--{{ $flash[0] }}">
            <p class="theme-toast__body">{{ $flash[1] }}</p>
            <button type="button" class="theme-toast__close" aria-label="Dismiss" @click="show = false">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
