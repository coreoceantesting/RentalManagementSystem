<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\Contractor\StoreRequest;
use App\Http\Requests\Admin\Masters\Contractor\UpdateRequest;
use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractors = Contractor::latest()->get();

        return view('admin.masters.contractors')->with(['contractors'=> $contractors]);
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
            Contractor::create($input);
            DB::commit();

            return response()->json(['success'=> 'Contractor created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Contractor');
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
    public function edit(Contractor $contractor)
    {
        if ($contractor)
        {
            $response = [
                'result' => 1,
                'contractor' => $contractor,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Contractor $contractor)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['updated_by'] = auth()->user()->id;
            $contractor->update($input);
            DB::commit();

            return response()->json(['success'=> 'Contractor updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Contractor');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contractor $contractor)
    {
        try
        {
            DB::beginTransaction();
            $contractor->delete();
            DB::commit();

            return response()->json(['success'=> 'Contractor deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Contractor');
        }
    }
}
