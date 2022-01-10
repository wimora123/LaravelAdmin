<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Closure;

use App\Http\Requests\UserFormValidation;
use App\Admin;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:3|max:191',
            'password' => 'required|min:3|max:191'
        ]);

        $username = $request->username;
        $password = $request->password;

        if(auth()->attempt(array('name' => $username, 'password' => $password))){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('adminLogin')->with('failed', 'Username atau password salah');
        }

    }

    public function postLogout(Request $request){
        Auth::logout();
        // $request->session->flush();
        return redirect()->route('adminLogin')->with('loginBack', 'Anda sudah logout');
    }
}
