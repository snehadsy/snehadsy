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
    public function register(){

        $states = State::get();
        $districts = District::get();
        $cities = City::get();
        return view('register',compact('states','districts','cities'));

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

              $storeSchool = new School();
              $storeSchool->name = $request->name;
              $storeSchool->address  = $request->address;
              $storeSchool->state_xid = $request->state;
              $storeSchool->district_xid = $request->district;
              $storeSchool->city_xid = $request->city;
              $storeSchool->established_at = $request->established_at;
              $storeSchool->login_id = $request->login_id;
              $storeSchool->password = Hash::make($request->password);
              $storeSchool->save();
              return successResponse(200, 'School registered successfully', $storeSchool);

          } catch (\Exception $e) {
              Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());
              return errorResponse();
          }
      }

      public function login(){

        return view('login');
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

              // If no school found, return error
              if (!$school) {
                  return errorResponse(401, 'Invalid login credentials');
              }

              // Check if the provided password matches the stored password
              if (!Hash::check($request->password, $school->password)) {
                  return errorResponse(401, 'Invalid login credentials');
              }

              // Store school_id in session for future use
              session(['school_id' => $school->id]);

              // Return success response if login is successful
              return successResponse(200, 'Logged in successfully', [
                  'id' => $school->id,
                  'name' => $school->name,
              ]);

            } catch (\Exception $e) {
                Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());
          }
      }




}