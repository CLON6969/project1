<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndividualProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust as needed
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\-]{7,20}$/'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'referral_source' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // 2MB
            'id_document_path' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'], // 4MB
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number format is invalid.',
            'profile_picture.image' => 'Profile picture must be a valid image file (jpg, jpeg, png).',
            'profile_picture.max' => 'Profile picture must not exceed 2MB.',
            'id_document_path.mimes' => 'ID document must be a file of type: jpg, jpeg, png, pdf.',
            'id_document_path.max' => 'ID document must not exceed 4MB.',
        ];
    }
}
