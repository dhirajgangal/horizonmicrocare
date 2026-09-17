<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^[6-9]\d{9}$/'],
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
            'consent' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'consent.accepted' => 'Please confirm that we may contact you and that this enquiry does not guarantee a loan.',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function inquiryPayload(): array
    {
        return $this->safe()->except(['consent', 'website']) + [
            'consent' => true,
        ];
    }
}
