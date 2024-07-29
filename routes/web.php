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
    


    // citizen routes
    Route::get('/application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'allApplicationList'])->name('list.all.applications');
    Route::get('/rejected-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'rejectedApplicationList'])->name('list.rejected.applications');
    Route::get('/hearing-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'hearingApplicationList'])->name('list.hearing.applications');
    Route::get('/close-application-list', [App\Http\Controllers\Admin\Citizen\ListingController::class, 'closeApplicationList'])->name('list.close.applications');

    // clerk routes
    Route::get('/complaint-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'complaintList'])->name('complaint.list');
    Route::get('/approved-complaint-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'approvedComplaintList'])->name('approved.complaint.list');

    Route::post('/complaints/{id}/approve', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'approveApplication'])->name('application.approve');
    Route::post('/application/reject', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'rejectApplication'])->name('application.reject');
    Route::post('/application/send', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendApplication'])->name('application.send');

    Route::post('/application/explantationone', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendExplainationOne'])->name('application.explaination.one');
    Route::post('/application/explantationtwo', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendExplainationTwo'])->name('application.explaination.two');
    Route::post('/application/explantationthree', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'sendExplainationThree'])->name('application.explaination.three');

    // hearing
    Route::post('/application/hearingdetails', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'storeHearingDetails'])->name('application.hearingDetails.store');
    Route::post('/application/hearing-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'hearingList'])->name('application.hearing.list');

    Route::get('/annexure-verification-list', [App\Http\Controllers\Admin\Clerk\ClerkActionController::class, 'annexureVerificationList'])->name('annexure.verification.list');




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
