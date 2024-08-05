<?php

namespace App\Http\Requests\Finance;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            "name_of_scheme" => "required",
            "location_of_scheme" => "required",
            "land_details" => "required",
            "developer_name" => "required",
            "architect_name" => "required",
            "name_of_slum_developer" => "required",
            "numbering_annexure_two" => "nullable",
            "bank_name" => "required",
            "bank_account_no" => "required",
            "upload_cancelled_cheque" => "nullable",
            "period_of_rent" => "required",
            "amount_to_pay" => "required",
            "paid_amount" => "required",
            "balance_amount" => "nullable",
        ];
    }
}
