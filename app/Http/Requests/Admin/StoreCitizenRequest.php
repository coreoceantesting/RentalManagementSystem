<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitizenRequest extends FormRequest
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
            'role' => 'nullable',
            'name' => 'nullable',
            'citizen_first_name' => 'nullable',
            'citizen_middle_name' => 'nullable',
            'citizen_last_name' => 'nullable',
            'address' => 'nullable',
            'is_citizen' => 'nullable',
            'email' => 'required|unique:users,email|email',
            'mobile' => 'required|unique:users,mobile|digits:10',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }
}
