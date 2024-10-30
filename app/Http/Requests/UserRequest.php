<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => 'required|string|min:8',
            'roles' => 'required',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field cannot be left empty.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must be a maximum of 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email field must be unique.',
            'email.regex'=> 'incorrect email format ',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password field must be a minimum of 8 characters.',
            'roles.required' => 'The roles field is required.',
        ];
    }
}