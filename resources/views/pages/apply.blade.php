<x-public-layout
    :title="__('Apply for a loan')"
    :breadcrumbs="[['label' => __('Apply for a loan')]]"
>
    <section class="bg-navy py-16 text-white">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <h1 class="font-serif text-4xl md:text-5xl">{{ __('Apply for a livelihood loan') }}</h1>
            <p class="mt-4 max-w-2xl text-white/75">{{ __('This is a first-step form. Sending it does not guarantee a loan, interest rate, or approval. We will contact you if we need more information.') }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-16 md:px-6">
        <form method="POST" action="{{ route('apply.store') }}" class="space-y-8">
            @csrf
            <div class="honeypot" aria-hidden="true">
                <label>{{ __('Website') }} <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            </div>

            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Loan details') }}</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <x-field :label="__('Loan product')" name="loan_product_id">
                        <select name="loan_product_id" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                            <option value="">{{ __('Select a product') }}</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @selected(old('loan_product_id', $selectedProductId) == $product->id)>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </x-field>
                    <x-field :label="__('Requested amount (₹)')" name="requested_amount">
                        <input type="number" name="requested_amount" value="{{ old('requested_amount') }}" min="1000" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                    </x-field>
                    <div class="md:col-span-2">
                        <x-field :label="__('Purpose of loan')" name="purpose">
                            <input name="purpose" value="{{ old('purpose') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                        </x-field>
                    </div>
                </div>
            </x-card>

            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Personal details') }}</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <x-field :label="__('Full name')" name="full_name"><input name="full_name" value="{{ old('full_name') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Mobile')" name="mobile"><input name="mobile" value="{{ old('mobile') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Email')" name="email"><input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Gender')" name="gender">
                        <select name="gender" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                            @foreach (['Woman', 'Man', 'Other', 'Prefer not to say'] as $gender)
                                <option value="{{ $gender }}" @selected(old('gender') === $gender)>{{ __($gender) }}</option>
                            @endforeach
                        </select>
                    </x-field>
                    <x-field :label="__('Date of birth')" name="date_of_birth"><input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Marital status (optional)')" name="marital_status">
                        <select name="marital_status" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                            <option value="">{{ __('Prefer not to say') }}</option>
                            @foreach (['Single', 'Married', 'Widowed'] as $status)
                                <option value="{{ $status }}" @selected(old('marital_status') === $status)>{{ __($status) }}</option>
                            @endforeach
                        </select>
                    </x-field>
                </div>
            </x-card>

            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Address') }}</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <x-field :label="__('State')" name="state">
                        <select name="state" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                            <option value="">{{ __('Select state') }}</option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}" @selected(old('state') === $state)>{{ $state }}</option>
                            @endforeach
                        </select>
                    </x-field>
                    <x-field :label="__('District')" name="district"><input name="district" value="{{ old('district') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Pincode')" name="pincode"><input name="pincode" value="{{ old('pincode') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <div class="md:col-span-2"><x-field :label="__('Address')" name="address"><textarea name="address" rows="3" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">{{ old('address') }}</textarea></x-field></div>
                </div>
            </x-card>

            <x-card>
                <h2 class="font-serif text-2xl text-navy">{{ __('Livelihood') }}</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <x-field :label="__('Occupation / livelihood')" name="occupation"><input name="occupation" value="{{ old('occupation') }}" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm"></x-field>
                    <x-field :label="__('Monthly income (optional)')" name="monthly_income">
                        <select name="monthly_income" class="w-full rounded-btn border border-border px-3 py-2.5 text-sm">
                            <option value="">{{ __('Prefer not to say') }}</option>
                            <option value="under-10000" @selected(old('monthly_income') === 'under-10000')>{{ __('Under ₹10,000') }}</option>
                            <option value="10000-25000" @selected(old('monthly_income') === '10000-25000')>{{ __('₹10,000 – ₹25,000') }}</option>
                            <option value="25000-50000" @selected(old('monthly_income') === '25000-50000')>{{ __('₹25,000 – ₹50,000') }}</option>
                            <option value="50000-plus" @selected(old('monthly_income') === '50000-plus')>{{ __('₹50,000 and above') }}</option>
                        </select>
                    </x-field>
                </div>
            </x-card>

            <x-card>
                <label class="flex items-start gap-3 text-sm text-text-2">
                    <input type="checkbox" name="consent" value="1" class="mt-1 rounded border-border" @checked(old('consent'))>
                    <span>{{ $site->consent_text }}</span>
                </label>
                @error('consent')
                    <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                @enderror
                <div class="mt-6">
                    <x-button type="submit">{{ __('Submit application') }}</x-button>
                </div>
            </x-card>
        </form>
    </section>
</x-public-layout>
