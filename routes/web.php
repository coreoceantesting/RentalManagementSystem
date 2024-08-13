<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return redirect()->route('login');
    return view('welcome');
})->name('/');




// Guest Users
Route::middleware(['guest','PreventBackHistory', 'firewall.all'])->group(function()
{
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'] )->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'] )->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
    Route::get('citizen/registration', [App\Http\Controllers\Admin\Citizen\CitizenController::class, 'citizenRegistration'] )->name('citizenRegistration');
    Route::post('citizen/registration/store', [App\Http\Controllers\Admin\Citizen\CitizenController::class, 'storeCitizenRegistration'])->name('storeCitizenRegistration');
    Route::get('citizen/login', [App\Http\Controllers\Admin\Citizen\CitizenController::class, 'citizenLoginPage'] )->name('citizenLoginPage');
    Route::post('citizen/login', [App\Http\Controllers\Admin\Citizen\CitizenController::class, 'citizenLogin'])->name('citizenLogin');
    Route::post('password/email', [App\Http\Controllers\Admin\Citizen\CitizenController::class, 'sendResetLinkEmail'])->name('password.email');
});




// Authenticated users
Route::middleware(['auth','PreventBackHistory', 'firewall.all'])->group(function()
{

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'] )->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'] )->name('change-password');



    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class );
    Route::resource('contractors', App\Http\Controllers\Admin\Masters\ContractorController::class );
    Route::resource('architects', App\Http\Controllers\Admin\Masters\ArchitectController::class );
    Route::resource('schemes', App\Http\Controllers\Admin\Masters\SchemeController::class );

    // complaint routes
    Route::resource('complaint', App\Http\Controllers\Admin\Complaint\ComplaintController::class );
    Route::get('/get-scheme-details/{id}', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'getSchemeDetails'])->name('get.scheme.details');
    Route::get('/view-application/{id}', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'viewApplicationDetails'])->name('view.application.details');
    Route::get('/edit-application/{id}', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'edit'])->name('edit.application.details');
    Route::put('/update-application/{id}', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'update'])->name('update.application.details');
    Route::post('/application/{id}/close', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'closeApplication'])->name('application.close');
    Route::post('/application/upload-doc', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'uploadDocbyContractor'])->name('application.upload.doc');
    Route::post('/application/upload-doc-two', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'uploadDoctwobyContractor'])->name('application.upload.doc.two');
    Route::post('/application/upload-doc-three', [App\Http\Controllers\Admin\Complaint\ComplaintController::class, 'uploadDocthreebyContractor'])->name('application.upload.doc.three');

    // citizen routes
    Route::get('/application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'allApplicationList'])->name('list.all.applications');
    Route::get('/rejected-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'rejectedApplicationList'])->name('list.rejected.applications');
    Route::get('/hearing-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'hearingApplicationList'])->name('list.hearing.applications');
    Route::get('/close-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'closeApplicationList'])->name('list.close.applications');

    Route::get('/explaination-call-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'explanationCallList'])->name('list.explaination');

    // clerk routes
    Route::get('/complaint-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'complaintList'])->name('complaint.list');
    Route::get('/approved-complaint-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'approvedComplaintList'])->name('approved.complaint.list');

    Route::post('/complaints/{id}/approve', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'approveApplication'])->name('application.approve');
    Route::post('/application/reject', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'rejectApplication'])->name('application.reject');
    Route::post('/application/send', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendApplication'])->name('application.send');
    Route::post('/application/reject/bycollector', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'rejectApplicationByCollector'])->name('application.reject.collector');

    Route::post('/application/explantationone', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendExplainationOne'])->name('application.explaination.one');
    Route::post('/application/explantationtwo', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendExplainationTwo'])->name('application.explaination.two');
    Route::post('/application/explantationthree', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendExplainationThree'])->name('application.explaination.three');
    Route::get('/application/explanation-call-details', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'explanationCallDetails'])->name('application.explainationCall.details');

    // hearing
    Route::post('/application/hearingdetails', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'storeHearingDetails'])->name('application.hearingDetails.store');
    Route::get('/application/hearing-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'hearingList'])->name('application.hearing.list');
    Route::get('/application/hearing-details', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'hearingDetails'])->name('application.hearing.details');

    // stop work
    Route::post('/application/stopwork', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'storeStopWorkDetails'])->name('application.stopwork.store');
    Route::get('/application/stopwork/list', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'stopWorkList'])->name('application.stopwork.list');
    Route::get('/application/stopwork/approved/list', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'stopWorkApprovedList'])->name('application.stopwork.approved.list');
    Route::get('/application/stopwork/rejected/list', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'stopWorkRejectedList'])->name('application.stopwork.rejected.list');
    Route::get('/application/stop-work-details', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'stopWorkDetails'])->name('application.stopWork.details');
    // approval of stop work
    Route::post('/stopwork/{id}/approve', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'approveStopWorkByRegistrar'])->name('registrar.approve.stopwork');
    Route::post('/stopwork/reject/', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'rejectStopWorkByRegistrar'])->name('registrar.reject.stopwork');
    Route::post('/close/application/', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'closeApplicationByRegistrar'])->name('registrar.close.application');

    Route::post('/stopwork/{id}/approve/secretary', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'approveStopWorkBySecretary'])->name('secretary.approve.stopwork');
    Route::post('/stopwork/reject/secretary', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'rejectStopWorkBySecretary'])->name('secretary.reject.stopwork');

    Route::post('/stopwork/{id}/approve/ceo', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'approveStopWorkByCeo'])->name('ceo.approve.stopwork');
    Route::post('/stopwork/reject/ceo', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'rejectStopWorkByCeo'])->name('ceo.reject.stopwork');

    // final stop work list
    Route::get('/final/stopwork/approved/list', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'finalStopWorkApprovedList'])->name('application.finalstopwork.approved.list');
    Route::get('/final/stopwork/rejected/list', [App\Http\Controllers\Admin\Complaint\StopWorkController::class, 'finalStopWorkRejectedList'])->name('application.finalstopwork.rejected.list');

    Route::get('/annexure-verification-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'annexureVerificationList'])->name('annexure.verification.list');

    Route::get('/total-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'totalApplicationList'])->name('total.application.list');


    // Scheme Details module
    Route::get('/scheme-details/add', [App\Http\Controllers\SchemeDetails\SchemeDetailsController::class, 'addForm'])->name('add.form');
    Route::post('/scheme-details/store', [App\Http\Controllers\SchemeDetails\SchemeDetailsController::class, 'storeForm'])->name('store.form');
    Route::get('/scheme-details/edit/{id}', [App\Http\Controllers\SchemeDetails\SchemeDetailsController::class, 'editForm'])->name('edit.form');
    Route::get('/scheme-details/list', [App\Http\Controllers\SchemeDetails\SchemeDetailsController::class, 'schemeDetailsList'])->name('list.schemeDetails');
    Route::put('/scheme-details/update/{id}', [App\Http\Controllers\SchemeDetails\SchemeDetailsController::class, 'updateForm'])->name('update.form');
    Route::get('/scheme-details/view/{id}', [App\Http\Controllers\SchemeDetails\SchemeDetailsController::class, 'viewForm'])->name('view.form');

    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class );
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle' ])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire' ])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword' ])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole' ])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole' ])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class );

});




Route::get('/php', function(Request $request){
    if( !auth()->check() )
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
