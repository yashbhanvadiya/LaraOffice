<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminForm;
use Hash;

class AdminFormController extends Controller
{
    public function AddForm()
    {
        return view('add_form');
    }
    
    public function addFormRecord(Request $req)
    {
        $req->validate([
            'fname' => 'required|max:20|min:2',
            'lname' => 'required|max:20|min:2',
            'email' => 'required|email|unique:admin_forms',
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'phone' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'pincode' => 'required',
        ]);

        $image_name = '';
        if($req->file('image'))
        {
            $file = $req->file('image');
            $image_name = rand(10000,99999).".".$file->getClientOriginalExtension();
            $file->move(public_path('admin/images/'),$image_name);
        }

        $m_images = '';
        if($req['mimages'])
        {
            foreach($req['mimages'] as $mfile)
            {
                $m_name = rand(10000,99999).".".$mfile->getClientOriginalExtension();
                $mfile->move(public_path('admin/mimages/'),$m_name);
                $m_im[] = $m_name;
            }
            $m_images = implode(',',$m_im);
        }

        $adminform = new AdminForm;
        $adminform->first_name = $req->fname;
        $adminform->last_name = $req->lname;
        $adminform->email = $req->email;
        $adminform->password = Hash::make($req->password);
        $adminform->phone = $req->phone;
        $adminform->gender = $req->gender;
        $adminform->state = $req->state;
        $adminform->city = $req->city;
        $adminform->address = $req->address;
        $adminform->pincode = $req->pincode;
        $adminform->description = $req->description;
        $adminform->image = $image_name;
        $adminform->mimages = $m_images;
        $adminform->save();

        return redirect('/add_form')->with('msg',1);
    }

    public function viewForm()
    {
        $FormRecord = AdminForm::paginate(5);
        return view('view_form', compact('FormRecord'));
    }

    public function DeleteRec($id)
    {
        $FormRec = AdminForm::find($id);
        if($FormRec->image) {
            $path = public_path("admin/images/$FormRec->image");
            if(file_exists($path))
            {
                unlink($path);
            }
        }

        $mimage = explode(',',$FormRec->mimages);
        foreach($mimage as $mim){
            if($mim) {
                $m_img = public_path("admin/mimages/".$mim);
                if(file_exists($m_img))
                {
                    @unlink($m_img);
                }
            }
        }

        AdminForm::find($id)->delete();
        return redirect('/view_form')->with('msg',1);
    }

    public function editField($id)
    {
        $FormRec = AdminForm::find($id);
        return view('/edit_form', compact('FormRec'));
    }

    public function editFormRecord(Request $req)
    {
        $req->validate([
            'fname' => 'required|max:20|min:2',
            'lname' => 'required|max:20|min:2',
            'email' => 'required|email|unique:admin_forms,email,'.$req->form_id,
            'phone' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'pincode' => 'required',
        ]);
        
        $FormEditRec = array('first_name'=>$req->fname,
                            'last_name'=>$req->lname,
                            'email'=>$req->email,
                            'phone'=>$req->phone,
                            'gender'=>$req->gender,
                            'state'=>$req->state,
                            'city'=>$req->city,
                            'address'=>$req->address,
                            'pincode'=>$req->pincode,
                            'description'=>$req->description);


        // Single Image Update
        $image_name = '';
        if($req->file('image'))
        {
            $file = $req->file('image');
            $image_name = rand(10000,99999).".".$file->getClientOriginalExtension();
            $file->move(public_path('admin/images/'),$image_name);

            $id = $req->form_id;
            $FormRec = AdminForm::find($id);
            if($FormRec->image) {
                $path = public_path("admin/images/$FormRec->image");
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
            $FormEditRec['image'] = $image_name;
        }


        // Multiple Image Update
        $m_images = '';
        if($req['mimages'])
        {
            foreach($req['mimages'] as $mfile)
            {
                $m_name = rand(10000,99999).".".$mfile->getClientOriginalExtension();
                $mfile->move(public_path('admin/mimages/'),$m_name);
                $m_im[] = $m_name;
            }
            $m_images = implode(',',$m_im);

            $id = $req->form_id;
            $FormRec = AdminForm::find($id);
            $mimage = explode(',',$FormRec->mimages);
            foreach($mimage as $mim){
                if($mim) {
                    $m_img = public_path("admin/mimages/".$mim);
                    if(file_exists($m_img))
                    {
                        @unlink($m_img);
                    }
                }
            }
            $FormEditRec['mimages'] = $m_images;
        }
        
        $id = $req->form_id;
        AdminForm::where('id',$id)->update($FormEditRec);
        return redirect('/view_form')->with('msg',1);
    }

    public function LiveSearch(Request $req)
    {
        if($req->ajax())
        {
            $data = AdminForm::where('id','like','%'.$req->search.'%')
                            ->orwhere('first_name','like','%'.$req->search.'%')
                            ->orwhere('last_name','like','%'.$req->search.'%')
                            ->orwhere('email','like','%'.$req->search.'%')->get();

            $output = '';
                foreach($data as $formRec){
                    $output.='<tr>'.
                        '<td>'.'<input type="checkbox" id="checkboxid" value="{{ $formRec->id }}">'.'</td>'.
                        '<td>'.$formRec->id.'</td>'.
                        '<td>'.$formRec->first_name.'</td>'.
                        '<td>'.$formRec->last_name.'</td>'.
                        '<td>'.$formRec->email.'</td>'.
                        '<td>'.$formRec->phone.'</td>'.
                        '<td>'.$formRec->gender.'</td>'.
                        '<td>'.$formRec->state.'</td>'.
                        '<td>'.$formRec->city.'</td>'.
                        '<td>'.$formRec->address.'</td>'.
                        '<td>'.$formRec->pincode.'</td>'.
                        '<td>'.$formRec->description.'</td>'.
                        '<td>'."<img src='admin/images/$formRec->image' width='50px' height='50px'>".'</td>'.
                        // '<td>'."
                        //         foreach(explode(',',$formRec->mimages) as $mim){
                        //             <img src='admin/mimages/'.$mim' width='50px' height='50px'>
                        //         }
                        //         ".'</td>'.
                        '<td>'."<a href='/delete-field/$formRec->id' class='delete-confirm'><i class='mdi mdi-delete'></i></a>".'</td>'.
                        '<td>'."<a href='/edit-field/$formRec->id' class='edit-confirm'><i class='mdi mdi-border-color'></i></a>".'</td>'.
                    '</tr>';
                }
        }
        else
        {   
            $FormRecord = AdminForm::paginate(5);
            return view('view_form', compact('FormRecord'));
        }

        return response ($output);
    }

    public function deleteMultipleRec(Request $req)
    {   
        $ids = $req->ids;
        AdminForm::whereIn('id',$ids)->delete();
        return response()->json(['success'=>'Record have been deleted']);
    }
}
