<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function Student()
    {
        $students = Student::all();
        return view('students', compact('students'));
    }

    public function AddStudent(Request $request)
    {
        $students = new Student;

        $students->fname = $request->input('fname');
        $students->lname = $request->input('lname');
        $students->course = $request->input('course');
        $students->section = $request->input('section');

        $students->save();
    }

    public function EditStudent(Request $request, $id)
    {
        $students = Student::find($id);

        $students->fname = $request->input('fname');
        $students->lname = $request->input('lname');
        $students->course = $request->input('course');
        $students->section = $request->input('section');

        $students->save();
    }
}
