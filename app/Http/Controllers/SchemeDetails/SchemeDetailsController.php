<?php

namespace App\Http\Controllers\SchemeDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Finance\StoreRequest;
use App\Models\SchemeDetails;
use Illuminate\Support\Facades\DB;

class SchemeDetailsController extends Controller
{
    public function addForm()
    {
        return view('schemeDetails.addForm');
    }

    public function storeForm(StoreRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = auth()->user()->id;
            $input['created_at'] = now();

            // Handle file uploads
            if ($request->hasFile('numbering_annexure_two')) {
                $appendixDoc = $request->file('numbering_annexure_two');
                $appendixDocPath = $appendixDoc->store('numbering_annexure_two', 'public');
                $input['numbering_annexure_two'] = $appendixDocPath;
            }

            if ($request->hasFile('upload_cancelled_cheque')) {
                $bankPassbook = $request->file('upload_cancelled_cheque');
                $bankPassbookPath = $bankPassbook->store('upload_cancelled_cheque', 'public');
                $input['upload_cancelled_cheque'] = $bankPassbookPath;
            }

           $complaint = SchemeDetails::create($input);

            DB::commit();

            return response()->json(['success'=> 'Details Store Successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'storing', 'details');
        }
    }

    public function schemeDetailsList()
    {
        $scheme_detail_lists = SchemeDetails::latest()->get();
        return view('schemeDetails.list')->with(['scheme_detail_lists' => $scheme_detail_lists]);
    }

    public function editForm($id)
    {
        $scheme_detail = SchemeDetails::findorFail($id);
        return view('schemeDetails.editForm')->with(['scheme_detail' => $scheme_detail]);
    }

}
