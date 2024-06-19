<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function index()
    {
        return view('login', [
            "title" => "Login to your account | E-Mart"
        ]);
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',

            ],
            [
                'email.required' => 'Email is required',
                'email.email' => 'Please enter valid email.',
                'password.required' => 'Password is required',
            ]
        );

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,

        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->roles == 'user') {
                return redirect()->route('index');
            } else if (Auth::user()->roles == 'administrator') {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('login')->withErrors(['You entered wrong email or password.'])->withInput();
        }
    }

    public function logout()
    {
        Auth()->guard('web')->logout();
        return redirect()->route('index');
    }
}
