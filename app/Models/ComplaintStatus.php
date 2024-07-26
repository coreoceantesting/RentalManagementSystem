<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'overall_status',
        'status',
        'explanation_call_one_at',
        'explanation_call_one_by',
        'explanation_doc_one',
        'explanation_subject_one',
        'explanation_call_two_at',
        'explanation_call_two_by',
        'explanation_doc_two',
        'explanation_subject_two',
        'explanation_call_three_at',
        'explanation_call_three_by',
        'explanation_doc_three',
        'explanation_subject_three',
        'contractor_explanation_doc_one',
        'contractor_explanation_doc_two',
        'contractor_explanation_doc_three',
        'hearing_doc',
        'hearing_place',
        'hearing_subject',
        'hearing_datetime',
        'send_to_collector_by',
        'send_to_collector_at',
        'send_to_collector_remark',
        'approval_by',
        'approval_at',
        'stop_work_subject',
        'stop_work_doc',
        'stop_work_approval_by',
        'stop_work_approval_at',
        'close_complaint_by',
        'close_complaint_at',
        'close_complaint_remark',

    ];
}
