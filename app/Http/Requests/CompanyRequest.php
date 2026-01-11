<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            // 'name' => 'required|string|max:255|unique:companies,name,' . $this->route('company')->id ?? 'NULL',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'name')
                    ->ignore(optional($this->route('company'))->id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('companies', 'email')
                    ->ignore(optional($this->route('company'))->id),
            ],
            'logo' => ['nullable', 'image', 'dimensions:min_width=100, min_height=100'],
            'website' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The name has already been taken.',
            'name.required' => 'The name field is required.',
            'email.email' => 'The email must be a valid email address.',
            'logo.image' => 'The logo must be an image file.',
            'logo.dimensions' => 'The logo must be at least 100x100 pixels.',
        ];
    }
}
