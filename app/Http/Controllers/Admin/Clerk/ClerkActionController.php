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
        $application_lists = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                                ->where('complaint_statuses.overall_status', 'Pending')
                                ->where('complaint_statuses.status', 'Pending')
                                ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status')
                                ->get();

        return view('clerk.complaintList')->with(['application_lists' => $application_lists]);
    }
}
