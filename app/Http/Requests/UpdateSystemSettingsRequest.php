<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSystemSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Convert checkbox values to boolean (unchecked checkboxes don't send a value)
        $this->merge([
            'maintenance_mode' => $this->has('maintenance_mode') ? (bool) $this->maintenance_mode : false,
            'registration_enabled' => $this->has('registration_enabled') ? (bool) $this->registration_enabled : false,
            'email_verification_required' => $this->has('email_verification_required') ? (bool) $this->email_verification_required : false,
        ]);
    }

    public function rules()
    {
        return [
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'maintenance_mode' => 'boolean',
            'registration_enabled' => 'boolean',
            'email_verification_required' => 'boolean',
            'max_file_upload_size' => 'required|integer|min:100|max:10240', // 100KB to 10MB
            'default_currency' => 'required|string|in:USD,EUR,GBP,JPY,CAD,AUD,CHF,CNY',
            'timezone' => 'required|string|timezone',
        ];
    }

    public function messages()
    {
        return [
            'site_name.required' => 'Site name is required.',
            'site_name.max' => 'Site name cannot exceed 255 characters.',
            'site_email.required' => 'Site email is required.',
            'site_email.email' => 'Please enter a valid email address.',
            'maintenance_mode.boolean' => 'Maintenance mode must be true or false.',
            'registration_enabled.boolean' => 'Registration enabled must be true or false.',
            'email_verification_required.boolean' => 'Email verification required must be true or false.',
            'max_file_upload_size.required' => 'Max file upload size is required.',
            'max_file_upload_size.integer' => 'Max file upload size must be a number.',
            'max_file_upload_size.min' => 'Max file upload size must be at least 100KB.',
            'max_file_upload_size.max' => 'Max file upload size cannot exceed 10MB.',
            'default_currency.required' => 'Default currency is required.',
            'default_currency.in' => 'Please select a valid currency.',
            'timezone.required' => 'Timezone is required.',
            'timezone.timezone' => 'Please select a valid timezone.',
        ];
    }
}
