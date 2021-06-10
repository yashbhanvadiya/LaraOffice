<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Student;
use Validator;

class DummyAPIController extends Controller
{
    public function getData()
    {
        return ['Name'=>'Yash', 'Email'=>'yash@gmail.com', 'Phone'=>'0123456789'];
    }

    public function studentsData($id=null)
    {
        return $id ? Student::find($id) : Student::all();
    }

    public function StudentDataAdd(Request $req)
    {
        $students = new Student;
        $students->fname = $req->first_name;
        $students->lname = $req->last_name;
        $students->course = $req->course;
        $students->section = $req->section;
        $result = $students->save();
        if($result)
        {
            return ["Result"=>"Data has been saved"];
        }
        else
        {
            return ["Result"=>"Data not saved"];
        }
    }

    public function StudentSearch($fname)
    {
        return Student::where("fname","like","%".$fname."%")->get();
    }

    public function StudentDelete($id)
    {
        $students = Student::find($id);
        $result = $students->delete();
        if($result)
        {
            return ["Result"=>"Data has been delete"];
        }
        else{
            return ["Result"=>"Delete opration is failed"];
        }
    }

    public function StudentValidateData(Request $req)
    {
        $rules = array(
            'first_name'=>'required|min:2|max:15',
            'last_name'=>'required|min:2|max:15',
            'course'=>'required',
            'section'=>'required',
        );
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {
            $students = new Student;
            $students->fname = $req->first_name;
            $students->lname = $req->last_name;
            $students->course = $req->course;
            $students->section = $req->section;
            $result = $students->save();
            if($result)
            {
                return ["Result"=>"Data has been saved"];
            }
            else
            {
                return ["Result"=>"Data not saved"];
            }
        }

    }

    public function FileSave(Request $req)
    {
        $result = $req->file('file')->store('APIs_file');
        return ['result'=>$result];
    }

    //Third party api data
    public function APIData(Request $req)
    {
        $collection = Http::get("https://reqres.in/api/users?page=1");
        return view('apidataview',['collection'=>$collection['data']]);
    }
    
}
