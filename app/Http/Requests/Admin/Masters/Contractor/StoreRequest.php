<?php

namespace App\Http\Requests\Admin\Masters\Contractor;

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
            'contractor_name' => 'required',
            'contractor_mobile_no' => 'required|min:10|max:10',
            'contractor_email' => 'required|email',
            'contractor_address' => 'required',
        ];
    }
}
