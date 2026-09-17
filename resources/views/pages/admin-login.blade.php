<x-admin-guest-layout :title="__('Sign in')">
    <div class="grid min-h-screen lg:grid-cols-2">
        <section class="relative hidden overflow-hidden bg-navy px-12 py-16 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="absolute -right-16 top-20 h-64 w-64 rounded-full bg-orange/20 blur-3xl"></div>
            <div class="absolute -left-10 bottom-10 h-48 w-48 rounded-full bg-white/5 blur-2xl"></div>
            <div class="relative">
                <div class="inline-flex rounded-xl border border-white/20 bg-white p-3 shadow-sm">
                    <img src="{{ asset('storage/images/logo-rectangle.png') }}" alt="{{ $site->organization_name }}" class="h-14 w-auto">
                </div>
                <p class="eyebrow mt-10">{{ __('Staff only') }}</p>
                <h1 class="mt-4 max-w-md font-serif text-5xl leading-tight">{{ $site->organization_name }}</h1>
                <p class="mt-5 max-w-sm text-lg text-white/75">{{ $site->tagline }}</p>
            </div>
            <p class="relative text-sm text-white/60">{{ __('Super Admin') }} · {{ __('Staff only') }}</p>
        </section>

        <section class="flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">
                <div class="mb-8 flex items-center justify-between lg:justify-end">
                    <div class="inline-flex rounded-xl border border-border bg-white p-2 shadow-sm lg:hidden">
                        <img src="{{ asset('storage/images/logo-square.png') }}" alt="{{ $site->organization_name }}" class="h-12 w-12">
                    </div>
                    <x-language-switcher />
                </div>
                <x-card class="shadow-xl">
                    <p class="eyebrow">{{ __('Super Admin') }}</p>
                    <h1 class="mt-2 font-serif text-3xl text-navy">{{ __('Sign in') }}</h1>
                    <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 space-y-4" x-data="{ show: false }">
                        @csrf
                        <x-field :label="__('Email')" name="email">
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                        </x-field>
                        <x-field :label="__('Password')" name="password">
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" class="w-full rounded-btn border border-border px-3 py-2.5 pr-12 text-sm">
                                <div
                                    class="absolute right-1 top-1/2 -translate-y-1/2"
                                    x-data="{ tip: false }"
                                    x-on:mouseenter="tip = true"
                                    x-on:mouseleave="tip = false"
                                    x-on:focusin="tip = true"
                                    x-on:focusout="tip = false"
                                >
                                    <button
                                        type="button"
                                        class="icon-btn inline-flex items-center justify-center rounded-btn text-navy hover:bg-paper"
                                        x-on:click="show = ! show"
                                        :aria-label="show ? '{{ __('Hide password') }}' : '{{ __('Show password') }}'"
                                    >
                                        <span x-show="! show"><x-ui-icon name="eye" /></span>
                                        <span x-show="show" x-cloak><x-ui-icon name="eye-slash" /></span>
                                    </button>
                                    <div
                                        x-show="tip"
                                        x-cloak
                                        x-transition.opacity
                                        class="pointer-events-none absolute bottom-full left-1/2 mb-2 -translate-x-1/2 whitespace-nowrap rounded-btn bg-navy px-2.5 py-1 text-xs font-semibold text-white shadow-lg"
                                        role="tooltip"
                                        x-text="show ? '{{ __('Hide password') }}' : '{{ __('Show password') }}'"
                                    ></div>
                                </div>
                            </div>
                        </x-field>
                        <label class="flex items-center gap-2 text-sm text-text-2">
                            <input type="checkbox" name="remember" class="rounded border-border"> {{ __('Remember me') }}
                        </label>
                        <x-button type="submit" class="w-full">{{ __('Sign in') }}</x-button>
                    </form>
                </x-card>
            </div>
        </section>
    </div>
</x-admin-guest-layout>
