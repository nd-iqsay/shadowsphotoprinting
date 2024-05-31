<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function login()
    {
        return view('admin.auth.login');
    }

    private function validator(Request $request)
	{
    //validation rules.
    $rules = [
        'email'    => 'required|email|exists:admins|min:5|max:191',
        'password' => 'required|string|min:4|max:255',
    ];

    //custom validation error messages.
    $messages = [
        'email.exists' => 'These credentials do not match our records.',
    ];

    //validate the request.
    $request->validate($rules,$messages);
	}

    public function loginPost(Request $request)
	{
        $this->validator($request); 

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){	
            return redirect()->route('admin.dashboard')->with('success','Your Name or password is Wrong!');
        }else{
            return back()->with('error','Your Name or password is Wrong!');
        }
        return $this->loginFailed();
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
