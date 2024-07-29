<?php

namespace App\Http\Controllers\Admin\Clerk;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintDetail;
use App\Models\ComplaintStatus;
use Illuminate\Http\Request;
use App\Models\Contractor;
use App\Models\Scheme;
use Carbon\Carbon;

class ClerkActionController extends Controller
{
    public function complaintList(Request $request)
    {
        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.overall_status', 'Pending')
                                ->where('complaint_statuses.status', 'Pending')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status')
                                ->get();

        return view('clerk.complaintList')->with(['application_lists' => $application_lists]);
    }

    public function approvedComplaintList(Request $request)
    {
        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.overall_status', 'Approved')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status')
                                ->get();

        return view('clerk.approvedList')->with(['application_lists' => $application_lists]);
    }

    
    public function approveApplication($id)
    {
        try {

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $id)->update([
                'overall_status' => 'Approved',
                'approval_by' => auth()->user()->id,
                'approval_at' => now()
            ]);

            return response()->json(['success' => 'Application approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error approving complaint.'], 500);
        }
    }

    public function rejectApplication(Request $request)
    {
        try {
            $applicationId = $request->application_id;
            $remark = $request->remark; 

            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'overall_status' => 'Rejected',
                'approval_remark' => $remark,
                'approval_by' => auth()->user()->id,
                'approval_at' => now()
            ]);


            return response()->json(['success' => 'Application rejected successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reject application!'], 500);
        }
    }

    public function sendApplication(Request $request)
    {
        try {
            $applicationId = $request->application_id;
            $remark = $request->sendremark; 

            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'overall_status' => 'Send To Collector',
                'send_to_collector_remark' => $remark,
                'send_to_collector_by' => auth()->user()->id,
                'send_to_collector_at' => now()
            ]);


            return response()->json(['success' => 'Application send to collector successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send application!'], 500);
        }
    }
}
