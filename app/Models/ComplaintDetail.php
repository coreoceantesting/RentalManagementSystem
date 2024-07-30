<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_name', 
        'applicant_current_address',
        'applicant_mobile_no', 
        'applicant_aadhar_no',
        'original_no', 
        'original_is_eligible',
        'appendix_no',
        'appendix_is_eligible',
        'appendix_doc',
        'scheme_name',
        'scheme_details',
        'contractor_name',
        'contractor_details',
        'date_of_demolition',
        'is_there_rental_agreement',
        'date_of_agreement',
        'monthly_rate_of_rent',
        'is_developer_paid_earlier_rent',
        'old_monthly_rate_of_rent',
        'date_of_previous_rent_was',
        'montly_received_rate',
        'bank_account_no',
        'bank_name',
        'bank_address',
        'ifsc_code',
        'copy_of_bank_passbook',
        'created_by', 
        'updated_by',
        'contractor_id'
    ];
}
