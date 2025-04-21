<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class studentController extends Controller
{
    public function index()
    {
        $students = Student::where('school_xid', 1)->with('standard')->get(); // here add conditionn according school login
        return view('index', compact('students'));
    }

    public function add()
    {
        $standards = Standard::all();
        return view('addStudent', compact('standards'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'standard_xid' => 'required|exists:standards,id',
                'gender' => 'required|in:male,female,other',
                'year' => 'required|numeric',
                'image' => 'required|image|max:2048',
                'contact' => 'required|digits_between:7,15',
            ]);

            if (isset($request->image)) {
                $image = $request->image;
                $imageName = singleImageUpload($image, 'School/image');
            }


            Student::create([
                'name' => $request->name,
                'standard_xid' => $request->standard_xid,
                'gender' => $request->gender,
                'year' => $request->year,
                'image' => $imageName,
                'contact' => $request->contact,
                'school_xid' =>  1, // remaining
            ]);

            return successResponse(200, 'Student created successfully');
        } catch (Exception $ex) {
            Log::error("An error occurred in adding student" . __METHOD__ . ": " . $ex->getMessage());
            return view('admin_dashboard.pages.error');
        }
    }
}
