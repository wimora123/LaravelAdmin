<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Closure;

use App\Http\Requests\UserFormValidation;
use App\Admin;
use App\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
    	$rules=[
    		 'username' => 'required|min:3|max:191',
             'password' => 'required|min:3|max:191'
    	];

    	$customMessage = [
    		'username.required' => 'Username tidak boleh kosong',
    		'username.min' => 'Username tidak boleh kurang dari 3 huruf',
    		'password.required' => 'Password tidak boleh kosong',
    		'password.min' => 'Password tidak boleh kurang dari 3 huruf'
    	];

        $this->validate($request, $rules, $customMessage);

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
