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
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                            ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                            ->where('complaint_statuses.overall_status', 'Pending')
                            ->where('complaint_statuses.status', 'Pending')
                            ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status')
                            ->orderBy('complaint_details.id', 'desc');

        // Check if the logged-in user is a contractor
        if (auth()->user()->roles->pluck('name')[0] == "contractor") {
            $query->where('complaint_details.contractor_id', auth()->user()->contractor_id);
        }

        $application_lists = $query->get();

        return view('clerk.complaintList')->with(['application_lists' => $application_lists]);
    }

    public function approvedComplaintList(Request $request)
    {
        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.overall_status', 'Approved')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*')
                                ->orderBy('complaint_details.id', 'desc')
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

    public function rejectApplicationByCollector(Request $request)
    {
        try {
            $applicationId = $request->application_id_new;
            $remark = $request->rejectedremark; 

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

    public function sendExplainationOne(Request $request)
    {
        // $request->validate([
        //     'subject' => 'required|string|max:255',
        //     'document' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        // ]);
    
        try {
                $applicationId = $request->applicationIdOne;
                $subject = $request->subject; 

                if ($request->hasFile('document')) {
                    $document = $request->file('document');
                    $DocPath = $document->store('explanation_call_one', 'public');
                }

                // Update the status
                DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                    'explanation_call_one_at' => now(),
                    'explanation_call_one_by' => auth()->user()->id,
                    'explanation_doc_one' => $DocPath,
                    'explanation_subject_one' => $subject,
                    'status' => "Explanation Call Send",
                ]);

                
            return response()->json(['success' => 'First explaination call send successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating data.']);
        }
    }

    public function sendExplainationTwo(Request $request)
    {
        // $request->validate([
        //     'subjectTwo' => 'required|string|max:255',
        //     'documentTwo' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        // ]);
    
        try {
                $applicationId = $request->applicationIdTwo;
                $subject = $request->subjectTwo; 

                if ($request->hasFile('documentTwo')) {
                    $document = $request->file('documentTwo');
                    $DocPath = $document->store('explanation_call_two', 'public');
                }

                // Update the status
                DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                    'explanation_call_two_at' => now(),
                    'explanation_call_two_by' => auth()->user()->id,
                    'explanation_doc_two' => $DocPath,
                    'explanation_subject_two' => $subject,
                    'status' => "Explanation Call Send",
                ]);

                
            return response()->json(['success' => 'Second explaination call send successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating data.']);
        }
    }


    public function sendExplainationThree(Request $request)
    {
        // $request->validate([
        //     'subjectThree' => 'required|string|max:255',
        //     'documentThree' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        // ]);
    
        try {
                $applicationId = $request->applicationIdThree;
                $subject = $request->subjectThree; 

                if ($request->hasFile('documentThree')) {
                    $document = $request->file('documentThree');
                    $DocPath = $document->store('explanation_call_three', 'public');
                }

                // Update the status
                DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                    'explanation_call_three_at' => now(),
                    'explanation_call_three_by' => auth()->user()->id,
                    'explanation_doc_three' => $DocPath,
                    'explanation_subject_three' => $subject,
                    'status' => "Explanation Call Send",
                ]);

                
            return response()->json(['success' => 'Third explaination call send successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating data.']);
        }
    }

    public function storeHearingDetails(Request $request)
    {
        // $request->validate([
        //     'subjectThree' => 'required|string|max:255',
        //     'documentThree' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        // ]);
    
        try {
                $applicationId = $request->hearingApplicationId;
                $subject = $request->hearingSubject; 
                $hearingPlace = $request->hearingPlace;
                $hearingTime = $request->hearingTime;

                if ($request->hasFile('hearingDocument')) {
                    $hearingDocument = $request->file('hearingDocument');
                    $DocPath = $hearingDocument->store('hearing_doc', 'public');
                }

                // Update the status
                DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                    'hearing_place' => $hearingPlace,
                    'hearing_subject' => $subject,
                    'hearing_doc' => $DocPath,
                    'hearing_datetime' => $hearingTime,
                    'status' => "Send For Hearing",
                ]);

                
            return response()->json(['success' => 'Hearing details send successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while sending data.']);
        }
    }

    public function annexureVerificationList(Request $request)
    {
        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.overall_status', 'Send To Collector')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*')
                                ->orderBy('complaint_details.id', 'desc')
                                ->get();

        return view('clerk.annexureVerificationList')->with(['application_lists' => $application_lists]);
    }

    public function hearingList(Request $request)
    {
        $query = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                            ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                            ->whereNotNull('complaint_statuses.hearing_doc')
                            ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*')
                            ->orderBy('complaint_details.id', 'desc');

        // Check if the logged-in user is a contractor
        if (auth()->user()->roles->pluck('name')[0] == "contractor") {
            $query->where('complaint_details.contractor_id', auth()->user()->contractor_id);
        }

        $application_lists = $query->get();

        return view('clerk.hearingList')->with(['application_lists' => $application_lists]);
    }

    public function hearingDetails(Request $request)
    {
        $applicationId = $request->input('id');

        // Fetch the hearing details from the database
        $details = DB::table('complaint_statuses')->where('complaint_id', $applicationId)->first([
            'hearing_doc',
            'hearing_place',
            'hearing_subject',
            'hearing_datetime'
        ]);

        if ($details) {
            return response()->json(['success' => true, 'data' => $details]);
        } else {
            return response()->json(['success' => false, 'error' => 'Details not found.']);
        }
    }

    public function explanationCallDetails(Request $request)
    {
        $applicationId = $request->input('id');

        // Fetch the hearing details from the database
        $details = DB::table('complaint_statuses')->where('complaint_id', $applicationId)->first([
            'explanation_doc_one',
            'explanation_subject_one',
            'explanation_doc_two',
            'explanation_subject_two',
            'explanation_doc_three',
            'explanation_subject_three',
            'contractor_explanation_doc_one'
        ]);

        if ($details) {
            return response()->json(['success' => true, 'data' => $details]);
        } else {
            return response()->json(['success' => false, 'error' => 'Details not found.']);
        }
    }

    public function storeStopWorkDetails(Request $request)
    {
    
        try {
                $applicationId = $request->applicationId;
                $subject = $request->subject; 

                if ($request->hasFile('document')) {
                    $document = $request->file('document');
                    $DocPath = $document->store('stop_work_doc', 'public');
                }

                // Update the status
                DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                    'stop_work_approval_at' => now(),
                    'stop_work_approval_by' => auth()->user()->id,
                    'stop_work_doc' => $DocPath,
                    'stop_work_subject' => $subject,
                    'status' => "Send For Stop Work",
                ]);

                
            return response()->json(['success' => 'Send For Stop Work Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while send for stop work.']);
        }
    }

}
