<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_of_scheme', 
        'location_of_scheme',
        'land_details', 
        'developer_name',
        'architect_name', 
        'name_of_slum_developer',
        'numbering_annexure_two',
        'bank_name',
        'bank_account_no',
        'upload_cancelled_cheque',
        'period_of_rent',
        'amount_to_pay',
        'paid_amount',
        'balance_amount',
        'created_by', 
        'updated_by'
    ];
}
