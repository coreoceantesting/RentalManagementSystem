<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CitizenComplaint\StoreRequest;
use App\Http\Requests\Admin\CitizenComplaint\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintDetail;
use App\Models\ComplaintStatus;
use App\Models\Contractor;
use App\Models\Scheme;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schemes_list = Scheme::latest()->get();
        $contractor_list = Contractor::latest()->get();
        return view('complaint.addComplaint')->with(['schemes_list' => $schemes_list, 'contractor_list' => $contractor_list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = auth()->user()->id;
            $input['created_at'] = now();

            // Handle file uploads
            if ($request->hasFile('appendix_doc')) {
                $appendixDoc = $request->file('appendix_doc');
                $appendixDocPath = $appendixDoc->store('appendix_docs', 'public');
                $input['appendix_doc'] = $appendixDocPath;
            }

            if ($request->hasFile('copy_of_bank_passbook')) {
                $bankPassbook = $request->file('copy_of_bank_passbook');
                $bankPassbookPath = $bankPassbook->store('bank_passbooks', 'public');
                $input['copy_of_bank_passbook'] = $bankPassbookPath;
            }

           $complaint = ComplaintDetail::create($input);

           ComplaintStatus::create([
                'complaint_id' => $complaint->id,
            ]);

            DB::commit();

            return response()->json(['success'=> 'Complaint Store Successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Complaint');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $application_detail = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.id', $id)
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*')
                                ->first();
        $schemes_list = Scheme::latest()->get();
        $contractor_list = Contractor::latest()->get();
            // dd($application_detail);

        return view('complaint.editComplaint')->with(['application_detail' => $application_detail, 'schemes_list' => $schemes_list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['updated_by'] = auth()->user()->id;
            $input['updated_at'] = now();

            // Fetch the existing record
            $ComplaintDetail = ComplaintDetail::findOrFail($id);

            // Handle file uploads
            if ($request->hasFile('appendix_doc')) {
                // Delete the old file
                if ($ComplaintDetail->appendix_doc) {
                    Storage::disk('public')->delete($ComplaintDetail->appendix_doc);
                }
                // Store the new file
                $appendixDoc = $request->file('appendix_doc');
                $appendixDocPath = $appendixDoc->store('appendix_docs', 'public');
                $input['appendix_doc'] = $appendixDocPath;
            }

            if ($request->hasFile('copy_of_bank_passbook')) {
                // Delete the old file
                if ($ComplaintDetail->copy_of_bank_passbook) {
                    Storage::disk('public')->delete($ComplaintDetail->copy_of_bank_passbook);
                }
                // Store the new file
                $bankPassbook = $request->file('copy_of_bank_passbook');
                $bankPassbookPath = $bankPassbook->store('bank_passbooks', 'public');
                $input['copy_of_bank_passbook'] = $bankPassbookPath;
            }

            // Update the record
            $ComplaintDetail->update($input);

            DB::commit();

            return response()->json(['success'=> 'Complaint Updated Successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updateing', 'Complaint');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSchemeDetails($id)
    {
        $scheme_detail = Scheme::find($id);
        $contractor_detail = Contractor::where('id', $scheme_detail->contractor)->first();

        return response()->json([
            'scheme_detail' => $scheme_detail,
            'contractor_detail' => $contractor_detail,
        ]);
    }

    public function viewApplicationDetails($id)
    {
        $application_detail = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_details.id', $id)
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.*')
                                ->first();
            // dd($application_detail);

        return view('complaint.viewComplaint')->with(['application_detail' => $application_detail]);
    }

    public function closeApplication($id)
    {
        try {

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $id)->update([
                'overall_status' => 'Closed',
                'status' => 'Closed',
                'close_complaint_by' => auth()->user()->id,
                'close_complaint_at' => now()
            ]);

            return response()->json(['success' => 'Application closed successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error closing complaint.'], 500);
        }
    }

    public function uploadDocbyContractor(Request $request)
    {
        try {
            $applicationId = $request->applicationIdOne;
            $subject = $request->remark_one; 

            if ($request->hasFile('document')) {
                $document = $request->file('document');
                $DocPath = $document->store('doc_by_contractor', 'public');
            }

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'contractor_explanation_doc_one' => $DocPath,
                'contractor_explanation_remark_one' => $subject,
                'contractor_explanation_one_at' => date('Y-m-d'),
                'contractor_explanation_one_by' =>  auth()->user()->id
            ]);

            
            return response()->json(['success' => 'Document Uploaded Successfully !']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while uploading document.']);
        }
    }

    public function uploadDoctwobyContractor(Request $request)
    {
        try {
            $applicationId = $request->applicationIdTwo;
            $subject = $request->remark_two; 

            if ($request->hasFile('document_two')) {
                $document = $request->file('document_two');
                $DocPath = $document->store('doc_by_contractor', 'public');
            }

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'contractor_explanation_doc_two' => $DocPath,
                'contractor_explanation_remark_two' => $subject,
                'contractor_explanation_two_at' => date('Y-m-d'),
                'contractor_explanation_two_by' =>  auth()->user()->id
            ]);

            
            return response()->json(['success' => 'Document Uploaded Successfully !']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while uploading document.']);
        }
    }

    public function uploadDocthreebyContractor(Request $request)
    {
        try {
            $applicationId = $request->applicationIdThree;
            $subject = $request->remark_three; 

            if ($request->hasFile('document_three')) {
                $document = $request->file('document_three');
                $DocPath = $document->store('doc_by_contractor', 'public');
            }

            // Update the status
            DB::table('complaint_statuses')->where('complaint_id', $applicationId)->update([
                'contractor_explanation_doc_three' => $DocPath,
                'contractor_explanation_remark_three' => $subject,
                'contractor_explanation_three_at' => date('Y-m-d'),
                'contractor_explanation_three_by' =>  auth()->user()->id
            ]);

            
            return response()->json(['success' => 'Document Uploaded Successfully !']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while uploading document.']);
        }
    }

}
