<?php

namespace App\Http\Controllers\Admin\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintDetail;
use App\Models\ComplaintStatus;
use Illuminate\Http\Request;
use App\Models\Contractor;
use App\Models\Scheme;
use Carbon\Carbon;

class ListingController extends Controller
{
    public function allApplicationList(Request $request){

        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.created_by', auth()->user()->id)
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status')
                                ->get();

        return view('citizen.allApplicationList')->with(['application_lists' => $application_lists]); 
    }

    public function rejectedApplicationList(Request $request){

        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.created_by', auth()->user()->id)
                                ->where('complaint_statuses.overall_status', 'Rejected')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.approval_remark')
                                ->get();
                                
        return view('citizen.rejectedApplicationList')->with(['application_lists' => $application_lists]); 
    }
}
