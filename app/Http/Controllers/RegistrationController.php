<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

use App\Http\Requests\UserFormValidation;

class RegistrationController extends Controller
{
    public function index(){
        return view('admin.register');
    }

    public function registerAdmin(Request $request){
        $user = new User;
        $this->validate($request, [
            'name' => 'required|min:3|max:25|unique:users,name,'.$user->id,
            'email'=> 'required|email|unique:users,email,'.$user->id,
            'password1'=> 'min:6|max:25|required_with:password_confirmation|same:password2',
            'password2' => 'min:6|max:25'
        ]);

        $name = $request->name;
        $email = $request->email;
        $password1 = $request->password1;
        $password2 = $request->password2;

        $user->name = $name;
        $user->email = $email;
        $user->password = Bcrypt($password1);

        $user->save();
        return redirect()->route('home');
    }
}
