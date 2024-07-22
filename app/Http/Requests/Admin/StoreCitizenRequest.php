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
            'citizen_first_name' => 'required',
            'citizen_middle_name' => 'required',
            'citizen_last_name' => 'required',
            'citizen_email' => 'required|email',
            'citizen_mobile_no' => 'required|digits:10',
            'citizen_address' => 'required',
            'citizen_username' => 'required',
            'password' => 'required|min:8',
        ];
    }
}
