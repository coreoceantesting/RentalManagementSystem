<?php

namespace App\Http\Controllers\Admin\Citizen;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreCitizenRequest;
use App\Models\Role;
use App\Models\RegisterCitizen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\StoreUserRequest;

class CitizenController extends Controller
{
    public function citizenRegistration(){
        return view('citizen.registration');
    }

    public function storeCitizenRegistrationOld(Request $request)
    {
        try {
            // Define validation rules
            $request->validate([
                'citizen_first_name' => 'required|max:255',
                'citizen_middle_name' => 'required|max:255',
                'citizen_last_name' => 'required|max:255',
                'citizen_mobile_no' => 'required|numeric|digits:10',
                'citizen_email' => 'required|email',
                'citizen_address' => 'required',
                'citizen_username' => 'required|max:255|unique:register_citizens',
                'password' => 'required|min:8',
            ]);

            DB::beginTransaction();
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $citizen = RegisterCitizen::create($input);
            DB::table('model_has_roles')->insert([
                'role_id' => 3, 
                'model_type' => 'App\Models\RegisterCitizen', 
                'model_id' => $citizen->id
            ]);
            DB::commit();
            return response()->json(['success' => 'Citizen Registration successfully!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error2' => 'An error occurred during registration.'], 500);
        }
    }

    public function citizenLoginPage()
    {
        return view('citizen.login');
    }

    public function citizenLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'Please enter username',
            'password.required' => 'Please enter password',
        ]);

        if ($validator->passes())
        {
            $username = $request->username;
            $password = $request->password;
            $remember_me = $request->has('remember_me') ? true : false;

            try
            {
                $user = User::where('email', $username)->where('is_citizen', 'Yes')->first();

                if(!$user)
                    return response()->json(['error2'=> 'No user found with this username']);

                if($user->active_status == '0' && !$user->roles)
                    return response()->json(['error2'=> 'You are not authorized to login, contact HOD']);

                if(!auth()->attempt(['email' => $username, 'password' => $password], $remember_me))
                    return response()->json(['error2'=> 'Your entered credentials are invalid']);

                $userType = '';
                if( $user->hasRole(['User']) )
                    $userType = 'user';

                return response()->json(['success'=> 'login successful', 'user_type'=> $userType ]);
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                Log::info("login error:". $e);
                return response()->json(['error2'=> 'Something went wrong while validating your credentials!']);
            }
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function storeCitizenRegistration(StoreCitizenRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            $input['address'] = $input['address'];
            $input['name'] = $input['citizen_first_name'].' '.$input['citizen_middle_name']. ' '. $input['citizen_last_name'];
            $input['is_citizen'] = "Yes";
            $user = User::create($input);
            DB::table('model_has_roles')->insert(['role_id'=> 3, 'model_type'=> 'App\Models\User', 'model_id'=> $user->id]);
            DB::commit();
            return response()->json(['success'=> 'Citizen Registration successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Citizen');
        }
    }



}
