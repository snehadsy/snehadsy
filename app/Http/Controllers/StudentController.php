<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use App\Models\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('index', compact('students'));
    }

    public function add()
    {
        $standards = Standard::all(); // here add condition according school login
        return view('addStudent', compact('standards'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'standard_xid' => 'required|exists:standards,id',
            'gender' => 'required|in:male,female,other',
            'year' => 'required|numeric',
            'image' => 'required|image|max:2048',
            'contact' => 'required|digits_between:7,15',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Student::create([
            'name' => $request->name,
            'standard_xid' => $request->standard_xid,
            'gender' => $request->gender,
            'year' => $request->year,
            'image' => $imageName,
            'contact' => $request->contact,
            'school_xid' =>  1,// remaining
        ]);

        return response()->json(['message' => 'Student created successfully']);
    }
}
