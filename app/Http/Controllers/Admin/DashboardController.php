<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\ComplaintDetail;
use App\Models\ComplaintStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $application_list = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                            ->leftjoin('schemes', 'complaint_details.scheme_name', '=', 'schemes.id')
                            ->select('complaint_details.*', 'schemes.scheme_name as SchemeName', 'complaint_statuses.overall_status')
                            ->orderBy('complaint_details.id', 'desc')
                            ->take(5)
                            ->get();
        $total_applications_count = ComplaintDetail::count();
        $total_approved_applications_count = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                            ->where('complaint_statuses.overall_status', '!=', 'Pending')
                                            ->where('complaint_statuses.overall_status', '!=', 'Rejected')
                                            ->count();
        $total_hearing_applications_count = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                            ->whereNotNull('complaint_statuses.hearing_datetime')
                                            ->count();
        $total_close_applications_count = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
        ->where('complaint_statuses.overall_status', '=', 'Closed')
        ->count();

        $total_work_stopped_applications_count = ComplaintDetail::leftjoin('complaint_statuses', 'complaint_details.id', '=', 'complaint_statuses.complaint_id')
                                                ->where('complaint_statuses.overall_status', '=', 'Work Stopped')
                                                ->count();

        return view('admin.dashboard')->with([
            'application_list' => $application_list,
            'total_applications_count' => $total_applications_count,
            'total_approved_applications_count' => $total_approved_applications_count,
            'total_hearing_applications_count' => $total_hearing_applications_count,
            'total_close_applications_count' => $total_close_applications_count,
            'total_work_stopped_applications_count' => $total_work_stopped_applications_count
        ]);
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
