<?php

namespace App\Http\Requests\Admin\CitizenComplaint;

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
            'applicant_name' => 'required',
            'applicant_current_address' => 'required',
            'applicant_mobile_no' => 'required|digits:10',
            'applicant_aadhar_no' => 'nullable|digits:12',
            'original_no' => 'required',
            'original_is_eligible' => 'required',
            'appendix_no' => 'required',
            'appendix_is_eligible' => 'required',
            'appendix_doc' => 'nullable|mimes:pdf,jpg,jpeg,png',
            'scheme_name' => 'required',
            'scheme_details' => 'required',
            'contractor_name' => 'required',
            'contractor_details' => 'required',
            'date_of_demolition' => 'required',
            'is_there_rental_agreement' => 'required',
            'date_of_agreement' => 'nullable',
            'monthly_rate_of_rent' => 'nullable',
            'is_developer_paid_earlier_rent' => 'required',
            'old_monthly_rate_of_rent' => 'nullable',
            'date_of_previous_rent_was' => 'required',
            'montly_received_date' => 'required',
            'bank_account_no' => 'required',
            'bank_name' => 'required',
            'bank_address' => 'required',
            'ifsc_code' => 'required',
            'copy_of_bank_passbook' => 'required|mimes:pdf,jpg,jpeg,png',
        ];
    }
}
