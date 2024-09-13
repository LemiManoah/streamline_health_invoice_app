<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'facility_level' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'client_email' => 'required|email:rfc,dns|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_phone' => 'required|string|max:20',
            'streamline_engineer_name' => 'required|string|max:255',
            'streamline_engineer_phone' => 'required|string|max:20',
            'streamline_engineer_email' => 'required|email:rfc,dns|max:255',
        ];
    }

    /**
     * Get custom messages for validation errors.
     **/
    public function messages(): array{
        return [
            'name.required' => 'The client name is required.',
            'facility_level.required' => 'The facility level is required.',
            'location.required' => 'The location is required.',
            'client_email.required' => 'The email for invoices is required.',
            'client_email.email' => 'The email for invoices must be a valid email address.',
            'contact_person_name.required' => 'The contact person name is required.',
            'contact_person_phone.required' => 'The contact person phone number is required.',
           'streamline_engineer_name.required' => 'The streamline engineer name is required.',
           'streamline_engineer_phone.required' => 'The streamline engineer phone number is required.',
           'streamline_engineer_email.required' => 'the streamline engineer email address is required.',
           'streamline_engineer_email.email' => 'The streamline engineer email must be a valid email address.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
