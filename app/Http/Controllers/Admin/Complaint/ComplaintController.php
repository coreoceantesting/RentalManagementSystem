<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contractor;
use App\Models\Scheme;

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
    public function store(Request $request)
    {
        //
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
}
