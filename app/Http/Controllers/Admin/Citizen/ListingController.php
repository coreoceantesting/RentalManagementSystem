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
use Auth;

class ListingController extends Controller
{
    public function allApplicationList(Request $request){

        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.created_by', auth()->user()->id)
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.explanation_call_one_at')
                                ->orderBy('complaint_details.id', 'desc')
                                ->get();

        return view('citizen.allApplicationList')->with(['application_lists' => $application_lists]);
    }

    public function rejectedApplicationList(Request $request){

        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.created_by', auth()->user()->id)
                                ->where('complaint_statuses.overall_status', 'Rejected')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.approval_remark')
                                ->orderBy('complaint_details.id', 'desc')
                                ->get();

        return view('citizen.rejectedApplicationList')->with(['application_lists' => $application_lists]);
    }

    public function hearingApplicationList(Request $request)
    {
        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.created_by', auth()->user()->id)
                                // ->where('complaint_statuses.status', 'Send For Hearing')
                                ->whereNotNull('complaint_statuses.hearing_datetime')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.approval_remark')
                                ->orderBy('complaint_details.id', 'desc')
                                ->get();

        return view('citizen.hearingApplicationList')->with(['application_lists' => $application_lists]);
    }

    public function closeApplicationList(Request $request)
    {
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                            ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                            ->where('complaint_statuses.overall_status', 'Closed')
                            ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.approval_remark');

        if (auth()->user()->roles->pluck('name')[0] == 'citizen') {
            $query->where('complaint_details.created_by', auth()->user()->id);
        }

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('citizen.closeApplicationList')->with(['application_lists' => $application_lists]);
    }

    public function explanationCallList()
    {
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                            ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                            ->whereNotNull('complaint_statuses.explanation_call_one_at')
                            ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.approval_remark');
        
        if (auth()->user()->roles->pluck('name')[0] == 'citizen') {
            $query->where('complaint_details.created_by', auth()->user()->id);
        }

        if (auth()->user()->roles->pluck('name')[0] == "contractor") {
            $query->where('complaint_details.contractor_id', auth()->user()->contractor_id);
        }

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('contractor.explainationCallApplicationList')->with(['application_lists' => $application_lists]);
    }

    public function totalApplicationList()
    {
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                            ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                            ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status', 'complaint_statuses.approval_remark');

        if (auth()->user()->roles->pluck('name')[0] == 'citizen') {
            $query->where('complaint_details.created_by', auth()->user()->id);
        }

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('complaint.totalApplicationList')->with(['application_lists' => $application_lists]);
    }
}
