<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;

class FormController extends Controller
{
    public function viewImage(){
 
    	$emp_data=DB::select('select * from forms');
 
    	return view('form',compact('emp_data'));
    }
 
    public function imguploadpost(Request $request){
    	if($request->ajax()){
    	   $data = $request->file('file');
           $file = $data->getClientOriginalName();
         //$extension = $data->getClientOriginalExtension();
           $filename = $file; //.'.'.$extension;// 
           $path =public_path('/images/');
 
 
            $usersImage = public_path("/images/{$filename}"); // get previous image from folder

            $db_table = DB::table('forms')->where('id','1')->first();
            if ($db_table) { // unlink or remove previous image from folder
               unlink($usersImage);
 
               DB::table('forms')->where('id','1')->update(['image' =>$filename]);
            }
            else
            {
                $pp='nofileexist';
                DB::table('forms')->insert(['id' => '1', 'image' => $filename]);
            }
 
           $upload_success = $data->move($path, $filename);
 
           return response()->json([
               'success' => 'done',
               'valueimg'=>$data
           ]);

 
    	}
    }
}
