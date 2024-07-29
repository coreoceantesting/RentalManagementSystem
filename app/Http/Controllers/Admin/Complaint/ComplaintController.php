<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CitizenComplaint\StoreRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintDetail;
use App\Models\ComplaintStatus;
use App\Models\Contractor;
use App\Models\Scheme;
use Carbon\Carbon;

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

}
