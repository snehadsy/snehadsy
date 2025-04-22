<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\School;
use App\Models\State;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function register()
    {

        try {
            $states = State::get();
            $districts = District::get();
            $cities = City::get();
            return view('register', compact('states', 'districts', 'cities'));
        } catch (\Exception $ex) {
            Log::error("An error occurred in " . __METHOD__ . ": " . $ex->getMessage());
            return view('error');
        }
    }


    public function registerStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255',
                'address' => 'required|string|max:500',
                'state'  => 'required|exists:states,id',
                'district' => 'required|exists:districts,id',
                'city'  => 'required|exists:cities,id',
                'established_at' => 'required|date',
                'login_id' => 'required|string|unique:schools,login_id',
                'password'  => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return errorResponse(422, 'Validation Error', $validator->errors());
            }

            $storeSchool = School::create([
                'name' => $request->name,
                'address' => $request->address,
                'state_xid' => $request->state,
                'district_xid' => $request->district,
                'city_xid' => $request->city,
                'established_at' => $request->established_at,
                'login_id' => $request->login_id,
                'password' => Hash::make($request->password),
            ]);

            return successResponse(200, 'School registered successfully', $storeSchool);
        } catch (\Exception $e) {
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());
            return errorResponse();
        }
    }

    public function login()
    {
        try {
            return view('login');
        } catch (\Exception $ex) {
            Log::error("An error occurred in " . __METHOD__ . ": " . $ex->getMessage());
            return view('error');
        }
    }


    public function verifyLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'login_id' => 'required|numeric',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return errorResponse(422, 'Validation Error', $validator->errors());
            }

            $school = School::where('login_id', $request->login_id)->first();

            if (!$school) {
                return errorResponse(401, 'Invalid login credentials');
            }

            if (!Hash::check($request->password, $school->password)) {
                return errorResponse(401, 'Invalid login credentials');
            }

            session(['school_xid' => $school->id]);
            $students = $school->students;
            return successResponse(200, 'Logged in successfully', [
                'school_id' => $school->id,
                'school_name' => $school->name,
                'students' => $students,
            ]);
        } catch (\Exception $e) {
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());
            return errorResponse();
        }
    }


    public function logout(Request $request)
    {
        try {
            session()->forget('school_xid');
            session()->flush();
            return successResponse(200, 'Logged out successfully');
        } catch (\Exception $e) {
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());
            return errorResponse();
        }
    }
}