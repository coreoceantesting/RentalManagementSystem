<?php

namespace App\Http\Requests\Admin\Masters\Architect;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'architect_name' => 'required',
            'architect_mobile_no' => 'required|min:10|max:10',
            'architect_email' => 'required|email',
            'architect_address' => 'required',
        ];
    }
}
