<?php

namespace App\Http\Requests;

use App\Support\IndianStates;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'loan_product_id' => ['required', 'integer', Rule::exists('loan_products', 'id')->where('is_active', true)],
            'requested_amount' => ['required', 'numeric', 'min:1000', 'max:5000000'],
            'purpose' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:120'],
            'mobile' => ['required', 'string', 'regex:/^[6-9]\d{9}$/'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'gender' => ['required', 'string', Rule::in(['Woman', 'Man', 'Other', 'Prefer not to say'])],
            'date_of_birth' => ['required', 'date', 'before:18 years ago'],
            'state' => ['required', 'string', Rule::in(IndianStates::names())],
            'district' => ['required', 'string', 'max:120'],
            'pincode' => ['required', 'string', 'regex:/^\d{6}$/'],
            'address' => ['required', 'string', 'max:500'],
            'occupation' => ['required', 'string', 'max:160'],
            'monthly_income' => ['nullable', 'string', Rule::in(['under-10000', '10000-25000', '25000-50000', '50000-plus'])],
            'marital_status' => ['nullable', 'string', Rule::in(['Single', 'Married', 'Widowed', 'Prefer not to say'])],
            'consent' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'consent.accepted' => __('Please confirm that we may contact you and that this form does not guarantee a loan.'),
            'date_of_birth.before' => __('Applicants must be at least 18 years old.'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'loan_product_id' => __('Loan product'),
            'requested_amount' => __('Requested amount (₹)'),
            'purpose' => __('Purpose of loan'),
            'full_name' => __('Full name'),
            'mobile' => __('Mobile'),
            'email' => __('Email'),
            'gender' => __('Gender'),
            'date_of_birth' => __('Date of birth'),
            'state' => __('State'),
            'district' => __('District'),
            'pincode' => __('Pincode'),
            'address' => __('Address'),
            'occupation' => __('Occupation / livelihood'),
            'monthly_income' => __('Monthly income (optional)'),
            'marital_status' => __('Marital status (optional)'),
            'consent' => __('Consent'),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function applicationPayload(): array
    {
        return $this->safe()->except(['consent', 'website']) + [
            'consent' => true,
        ];
    }
}
