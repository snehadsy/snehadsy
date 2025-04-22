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
        $students = Student::where('school_xid', session('school_xid'))
        ->with('standard')
        ->get();
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

            $schoolId = session('school_xid');

            if (!$schoolId) {
                return errorResponse(403, 'Unauthorized: School not found in session.');
            }

            if (isset($request->image)) {
                $image = $request->image;
                $imageName = singleImageUpload($image, 'School/image');
            }

            Student::create([
                'name' => $request->name,
                'standard_xid' => $request->standard_xid,
                'gender' => $request->gender,
                'year' => $request->year,
                'image' => $imageName ?? null,
                'contact' => $request->contact,
                'school_xid' => $schoolId, // using session value
            ]);

            return successResponse(200, 'Student created successfully');
        } catch (Exception $ex) {
            Log::error("An error occurred in adding student " . __METHOD__ . ": " . $ex->getMessage());
            return view('admin_dashboard.pages.error');
        }
    }


    public function show($id)
    {
        try {
            $student = Student::with('standard', 'school')->find($id);
            if (!$student) {
                return redirect()->route('students.index')->withErrors(['message' => 'Student Not Found.']);
            }
            return view('viewStudent', compact('student'));
        } catch (Exception $e) {
            Log::error("An error occurred in " . __METHOD__ . ": " . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);

            if ($student->image && file_exists(public_path('storage/app/public/uploads/School/image/' . $student->image))) {
                unlink(public_path('storage/app/public/uploads/School/image/' . $student->image));
            }
            $student->delete();

            return successResponse(200, 'Student deleted successfully.');
        } catch (Exception $e) {
            Log::error("An error occurred while deleting the student: " . $e->getMessage());
            return redirect()->route('students.index')->withErrors(['error' => 'Failed to delete the student.']);
        }
    }


    public function edit($id)
    {
        try {
            $standards = Standard::all();
            $student = Student::with('standard', 'school')->findOrFail($id);
            if (!$student) {
                return redirect()->route('manage_article')->withErrors(['message' => 'Blog Not Found.']);
            }
            return view('editStudent', compact('student', 'standards'));
        } catch (Exception $e) {
            Log::error("An error occurred in editing the ppage " . __METHOD__ . ": " . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'standard_id' => 'required|exists:standards,id',
            'gender' => 'required|in:male,female,other',
            'year' => 'required|integer',
            'contact' => 'required|string|max:20',
        ]);

        try {
            $student = Student::findOrFail($id);

            $student->name = $request->name;
            $student->standard_xid = $request->standard_id;
            $student->gender = $request->gender;
            $student->year = $request->year;
            $student->contact = $request->contact;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = singleImageUpload($image, 'School/image');

                if ($student->image && file_exists(storage_path('app/public/uploads/School/image/' . $student->image))) {
                    unlink(storage_path('app/public/uploads/School/image/' . $student->image));
                }
            } else {
                $imageName = $student->image;
            }
            $student->image = $imageName;
            $student->save();

            return successResponse(200, 'Student updated successfully.');
        } catch (\Exception $e) {
            Log::error("Error updating student: " . $e->getMessage());
            return back()->withErrors(['message' => 'Failed to update student.']);
        }
    }
}
