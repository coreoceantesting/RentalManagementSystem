<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintDetail;
use App\Models\ComplaintStatus;
use Illuminate\Http\Request;
use App\Models\Contractor;
use App\Models\Scheme;
use Carbon\Carbon;

class StopWorkController extends Controller
{
    public function stopWorkList()
    {
        $userRole = auth()->user()->roles->pluck('name')[0];

        
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.status', '=', 'Send For Stop Work')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*');

        switch ($userRole) {
            case 'registrar':
                $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Pending');
                break;

            case 'secretary':
                $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Approved')
                    ->where('complaint_statuses.stopwork_status_by_secretory', '=', 'Pending');
                break;

            case 'ceo':
                $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Approved')
                    ->where('complaint_statuses.stopwork_status_by_secretory', '=', 'Approved')
                    ->where('complaint_statuses.stopwork_status_by_ceo', '=', 'Pending');
                break;
        }

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('stopWork.allApplicationList', ['application_lists' => $application_lists]);
    }

    public function stopWorkApprovedList()
    {
        $userRole = auth()->user()->roles->pluck('name')[0];

        
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                // ->where('complaint_statuses.status', '=', 'Send For Stop Work')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*');

        switch ($userRole) {
            case 'registrar':
                $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Approved');
                break;

            case 'secretary':
                $query->where('complaint_statuses.stopwork_status_by_secretory', '=', 'Approved');
                break;

            case 'ceo':
                $query->where('complaint_statuses.stopwork_status_by_ceo', '=', 'Approved');
                break;
        }

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('stopWork.allApplicationApprovedList')->with(['application_lists' => $application_lists]);
    }

    public function stopWorkRejectedList()
    {
        $userRole = auth()->user()->roles->pluck('name')[0];

        
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.status', '=', 'Send For Stop Work')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*');

        switch ($userRole) {
            case 'registrar':
                $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Rejected');
                break;

            case 'secretary':
                $query->where('complaint_statuses.stopwork_status_by_secretory', '=', 'Rejected');
                break;

            case 'ceo':
                $query->where('complaint_statuses.stopwork_status_by_ceo', '=', 'Rejected');
                break;

            case 'citizen':
                $query->where(function($query) {
                    $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Rejected')
                            ->orWhere('complaint_statuses.stopwork_status_by_secretory', '=', 'Rejected')
                            ->orWhere('complaint_statuses.stopwork_status_by_ceo', '=', 'Rejected');
                })
                ->where('complaint_details.created_by', '=', auth()->user()->id);
                break;
    
            case 'contractor':
                $query->where(function($query) {
                    $query->where('complaint_statuses.stopwork_status_by_register', '=', 'Rejected')
                            ->orWhere('complaint_statuses.stopwork_status_by_secretory', '=', 'Rejected')
                            ->orWhere('complaint_statuses.stopwork_status_by_ceo', '=', 'Rejected');
                })
                ->where('complaint_details.contractor_id', '=', auth()->user()->id);
                break;
        }

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('stopWork.allApplicationRejectedList')->with(['application_lists' => $application_lists]);
    }

    public function stopWorkDetails(Request $request) {
        $applicationId = $request->input('id');

        // Fetch the hearing details from the database
        $details = DB::table('complaint_statuses')->where('complaint_id', $applicationId)->first([
            'stop_work_subject',
            'stop_work_doc',
            'stop_work_approval_by',
            'stop_work_approval_at'
        ]);

        if ($details) {
            return response()->json(['success' => true, 'data' => $details]);
        } else {
            return response()->json(['success' => false, 'error' => 'Details not found.']);
        }
    }

    // approval by registrar
    public function approveStopWorkByRegistrar($id)
    {
        try {

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $id)->update([
                'stopwork_status_by_register' => 'Approved',
                'stopwork_approval_by_register_id' => auth()->user()->id,
                'stopwork_approval_at_by_register' => now()
            ]);

            return response()->json(['success' => 'Application approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error approving complaint.'], 500);
        }
    }

    public function rejectStopWorkByRegistrar(Request $request)
    {
        try {
            $applicationId = $request->remarkByRegistrar_application_id;
            $remark = $request->remarkByRegistrar; 

            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'stopwork_status_by_register' => 'Rejected',
                'stopwork_approval_remark_by_register' => $remark,
                'stopwork_approval_by_register_id' => auth()->user()->id,
                'stopwork_approval_at_by_register' => now()
            ]);


            return response()->json(['success' => 'Application rejected successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reject application!'], 500);
        }
    }

    public function closeApplicationByRegistrar(Request $request)
    {
        try {
            $applicationId = $request->close_application_id;
            $remark = $request->closeremark; 

            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'overall_status' => 'Closed',
                'status' => 'Closed',
                'close_complaint_by' => auth()->user()->id,
                'close_complaint_at' => now(),
                'close_complaint_remark' => $remark
            ]);


            return response()->json(['success' => 'Application Closed successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to closed application!'], 500);
        }
    }

    // approval by secretary

    public function approveStopWorkBySecretary($id)
    {
        try {

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $id)->update([
                'stopwork_status_by_secretory' => 'Approved',
                'stopwork_approval_by_secretory_id' => auth()->user()->id,
                'stopwork_approval_at_by_secretory' => now()
            ]);

            return response()->json(['success' => 'Application approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error approving complaint.'], 500);
        }
    }

    public function rejectStopWorkBySecretary(Request $request)
    {
        try {
            $applicationId = $request->remarkBySecretary_application_id;
            $remark = $request->remarkBySecretary; 

            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'stopwork_status_by_secretory' => 'Rejected',
                'stopwork_approval_remark_by_secretory' => $remark,
                'stopwork_approval_by_secretory_id' => auth()->user()->id,
                'stopwork_approval_at_by_secretory' => now()
            ]);


            return response()->json(['success' => 'Application rejected successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reject application!'], 500);
        }
    }

    // approval by ceo

    public function approveStopWorkByCeo($id)
    {
        try {

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $id)->update([
                'stopwork_status_by_ceo' => 'Approved',
                'overall_status' => 'Work Stopped',
                'status' => 'Work Stopped',
                'stopwork_approval_by_ceo_id' => auth()->user()->id,
                'stopwork_approval_at_by_ceo' => now()
            ]);

            return response()->json(['success' => 'Application approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error approving complaint.'], 500);
        }
    }

    public function rejectStopWorkByCeo(Request $request)
    {
        try {
            $applicationId = $request->remarkByCeo_application_id;
            $remark = $request->remarkByCeo; 

            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'stopwork_status_by_ceo' => 'Rejected',
                'stopwork_approval_remark_by_ceo' => $remark,
                'stopwork_approval_by_ceo_id' => auth()->user()->id,
                'stopwork_approval_at_by_ceo' => now()
            ]);


            return response()->json(['success' => 'Application rejected successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reject application!'], 500);
        }
    }

    // final stop work
    public function finalStopWorkApprovedList()
    {

        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.stopwork_status_by_ceo', '=', 'Approved')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*');

        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('stopWork.finalApprovedList')->with(['application_lists' => $application_lists]);
    }

    public function finalStopWorkRejectedList()
    {
   
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.stopwork_status_by_ceo', '=', 'Rejected')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*');


        $application_lists = $query->orderBy('complaint_details.id', 'desc')->get();

        return view('stopWork.finalRejectedList')->with(['application_lists' => $application_lists]);
    }

}
