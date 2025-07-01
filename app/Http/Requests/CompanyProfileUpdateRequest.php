<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'name' => ['required', 'string', 'max:255'], // Company Name
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($userId)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\-]{7,20}$/'],
            'industry' => ['nullable', 'string', 'max:255'],
            'company_registration_number' => ['nullable', 'string', 'max:255'],
            'tax_id' => ['nullable', 'string', 'max:255'],
            'organization_size' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'referral_source' => ['nullable', 'string', 'max:255'],
            'business_license_path' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'], // 4MB
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number format is invalid.',
            'business_license_path.mimes' => 'Business license must be a file of type: pdf, jpg, jpeg, png.',
            'business_license_path.max' => 'Business license must not exceed 4MB.',
            'profile_picture.image' => 'Profile picture must be a valid image file (jpg, jpeg, png).',
            'profile_picture.max' => 'Profile picture must not exceed 2MB.',
        ];
    }
}
