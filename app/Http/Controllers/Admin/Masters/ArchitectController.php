<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\Architect\StoreRequest;
use App\Http\Requests\Admin\Masters\Architect\UpdateRequest;
use App\Models\Architect;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ArchitectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $architects = Architect::latest()->get();

        return view('admin.masters.architects')->with(['architects'=> $architects]);
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
            Architect::create($input);
            DB::commit();

            return response()->json(['success'=> 'Architect created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Architect');
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
    public function edit(Architect $architect)
    {
        if ($architect)
        {
            $response = [
                'result' => 1,
                'architect' => $architect,
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
    public function update(UpdateRequest $request, Architect $architect)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['updated_by'] = auth()->user()->id;
            $architect->update($input);
            DB::commit();

            return response()->json(['success'=> 'Architect updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Architect');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Architect $architect)
    {
        try
        {
            DB::beginTransaction();
            $architect->delete();
            DB::commit();

            return response()->json(['success'=> 'Architect deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Architect');
        }
    }
}
