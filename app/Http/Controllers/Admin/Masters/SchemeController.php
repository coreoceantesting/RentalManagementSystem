<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\scheme\StoreRequest;
use App\Http\Requests\Admin\Masters\scheme\UpdateRequest;
use App\Models\Architect;
use App\Models\Contractor;
use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shemes = Scheme::join('contractors', 'schemes.contractor', '=', 'contractors.id')
        ->join('architects', 'schemes.architect', '=', 'architects.id')
        ->whereNull('schemes.deleted_by')
        ->select('schemes.*', 'contractors.contractor_name', 'architects.architect_name')
        ->orderBy('schemes.id', 'desc')
        ->get();
        $contractors = Contractor::latest()->get();
        $architects = Architect::latest()->get();

        return view('admin.masters.schemes')->with(['shemes'=> $shemes, 'contractors' => $contractors, 'architects' => $architects]);
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
            Scheme::create($input);
            DB::commit();

            return response()->json(['success'=> 'Scheme created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Scheme');
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
    public function edit(Scheme $scheme)
    {
        if ($scheme)
        {
            $response = [
                'result' => 1,
                'scheme' => $scheme,
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
    public function update(UpdateRequest $request, Scheme $scheme)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['updated_by'] = auth()->user()->id;
            $scheme->update($input);
            DB::commit();

            return response()->json(['success'=> 'Scheme updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Scheme');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scheme $scheme)
    {
        try
        {
            DB::beginTransaction();
            $scheme->delete();
            DB::commit();

            return response()->json(['success'=> 'Scheme deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Scheme');
        }
    }
}
