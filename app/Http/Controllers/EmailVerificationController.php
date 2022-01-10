<?php

use App\Http\Controllers\Controller;
use Auth;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('admin.verify');
    }

    public function request()
    {
        auth()->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('dashboard'); // <-- change this to whatever you want
    }
}