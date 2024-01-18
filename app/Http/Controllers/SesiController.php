<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SesiController extends Controller
{

    public function index()
    {
        return view('sesi/login');
    }


    public function login(Request $request)
    {
        Session::flash('email', $request->email);

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Please fill the email.',
            'password.required' => 'Please fill the password.',
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('login')->withErrors("Email or Password Doesn't Match with the Database");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
