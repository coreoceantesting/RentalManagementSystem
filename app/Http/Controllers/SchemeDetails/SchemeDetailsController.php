<?php

namespace App\Http\Controllers\SchemeDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Finance\StoreRequest;
use App\Http\Requests\Finance\UpdateRequest;
use App\Models\SchemeDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function updateForm(UpdateRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['updated_by'] = auth()->user()->id;
            $input['updated_at'] = now();

            // Fetch the existing record
            $schemeDetail = SchemeDetails::findOrFail($id);

            // Handle file uploads and delete old images
            if ($request->hasFile('numbering_annexure_two')) {
                // Delete the old file
                if ($schemeDetail->numbering_annexure_two) {
                    Storage::disk('public')->delete($schemeDetail->numbering_annexure_two);
                }
                // Store the new file
                $appendixDoc = $request->file('numbering_annexure_two');
                $appendixDocPath = $appendixDoc->store('numbering_annexure_two', 'public');
                $input['numbering_annexure_two'] = $appendixDocPath;
            }

            if ($request->hasFile('upload_cancelled_cheque')) {
                // Delete the old file
                if ($schemeDetail->upload_cancelled_cheque) {
                    Storage::disk('public')->delete($schemeDetail->upload_cancelled_cheque);
                }
                // Store the new file
                $bankPassbook = $request->file('upload_cancelled_cheque');
                $bankPassbookPath = $bankPassbook->store('upload_cancelled_cheque', 'public');
                $input['upload_cancelled_cheque'] = $bankPassbookPath;
            }

            // Update the record
            $schemeDetail->update($input);

            DB::commit();

            return response()->json(['success'=> 'Details Updated Successfully!']);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->respondWithAjax($e, 'updating', 'details');
        }
    }

    public function viewForm($id)
    {
        $scheme_detail = SchemeDetails::findorFail($id);
        return view('schemeDetails.viewForm')->with(['scheme_detail' => $scheme_detail]);
    }

}
