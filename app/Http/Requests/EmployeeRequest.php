<?php

namespace App\Http\Requests;

use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'exists:companies,id'],
            'email' => [
                'nullable', 
                'email', 
                'max:255',
                Rule::unique('employees')->ignore($this->employee)    
            ],
            'phone' => ['nullable', 'string', 'min:10', 'max:12'],
            'profile_picture' => [
                'nullable', 
                'image', 
                'mimes:png,jpeg', 
                'max:1024',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $extension = strtolower($value->getClientOriginalExtension());
                        if (!in_array($extension, ['jpeg', 'png'])) {
                            $fail('The profile picture must be a JPEG or PNG file.');
                        }
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'company_id.required' => 'Company is required.',
            'company_id.exists' => 'Selected company does not exist.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'phone.min' => 'Phone number must be at least 10 digits.',
            'phone.max' => 'Phone number must not exceed 12 digits.',
            'profile_picture.image' => 'Profile picture must be an image.',
            'profile_picture.mimes' => 'Profile picture must be a file of type: png, jpeg.',
            'profile_picture.max' => 'Profile picture must not exceed 1MB in size.',
        ];
    }
}
