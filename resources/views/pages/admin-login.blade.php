<x-admin-guest-layout :title="__('Sign in')">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-navy px-4 py-10">
        <div class="absolute -left-24 top-16 h-64 w-64 rounded-full bg-white/5"></div>
        <div class="absolute -right-16 bottom-10 h-56 w-56 rounded-full bg-orange/10"></div>

        <div class="relative grid w-full max-w-5xl overflow-hidden rounded-xl bg-surface shadow-xl lg:grid-cols-2">
            <section class="order-1 p-6 md:p-8 lg:order-2">
                <div class="grid grid-cols-3 items-center">
                    <div></div>
                    <p class="text-center text-xs font-semibold text-orange">{{ __('Super Admin') }}</p>
                    <div class="flex justify-end">
                        <x-language-switcher />
                    </div>
                </div>

                <div class="mt-5 flex justify-center">
                    <img
                        src="{{ asset('storage/images/logo-rectangle.png') }}"
                        alt="{{ $site->organization_name }}"
                        class="hidden h-12 w-auto lg:block"
                    >
                    <img
                        src="{{ asset('storage/images/logo-square.png') }}"
                        alt="{{ $site->organization_name }}"
                        class="h-10 w-10 lg:hidden"
                    >
                </div>

                <div class="mt-5 flex flex-col items-center text-center">
                    <h1 class="font-serif text-3xl text-navy">{{ __('Sign in') }}</h1>
                    <span class="mt-2 h-1 w-8 rounded-full bg-orange" aria-hidden="true"></span>
                </div>

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
            </section>

            <section class="relative order-2 hidden h-full min-h-full overflow-hidden bg-navy lg:order-1 lg:block">
                <img
                    src="{{ asset('storage/images/login-illustration.jpg') }}"
                    alt="{{ __('Staff sign-in illustration') }}"
                    class="absolute inset-0 h-full w-full object-cover object-center"
                >
            </section>
        </div>
    </div>
</x-admin-guest-layout>
