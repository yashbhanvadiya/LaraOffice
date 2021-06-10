<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class UserController extends Controller
{  
    public function dashboard()
    {
        return view('index');
    }
    
    public function RegisterForm()
    {
        return view('auth.register');
    }

    public function LoginForm()
    {   
        if(Auth::check())
        {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function RegisterFormRec(Request $req)
    {
        $req->validate([
            'name' => 'required|max:20|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed'
        ]);

        $RegisterForm = new User;
        $RegisterForm->name = $req->name;
        $RegisterForm->email = $req->email;
        $RegisterForm->password = Hash::make($req->password);
        $RegisterForm->save();

        Auth::login($RegisterForm);
        return redirect('/');
    }

    public function LoginFormRec(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $req ->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/');
        }

        session()->flash('loginError','Invalid Email & Password');
        
        return redirect('/login');
    }

    public function LogoutRec()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit_profile', compact('user'));
    }
    
    public function editUserRecord(Request $req)
    {
        $req->validate([
            'name' => 'required|max:20|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed'
        ]);

        $user = Auth::user();
        $user->update(['name' => request('name'),'email' => request('email'), 'password' => Hash::make(request('password'))]);
        return redirect('/edit-profile')->with('msg',1);
    }

}
