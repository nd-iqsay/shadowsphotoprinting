<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLogin;
class AuthController extends Controller
{
   public function login()
    {
        return view('admin.auth.login');
    }

    public function loginPost(AdminLogin $request)
	{
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){	
            return redirect()->route('admin.dashboard')->with('success','Your Name or password is Wrong!');
        }else{
            return back()->with('error','Your Name or password is Wrong!');
        }
      
	}

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
	{
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.post')->with('status','Admin has been logged out!');
	}
}
