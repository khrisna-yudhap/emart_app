<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('signup', [
            'title' => 'Sign up new account | E-Mart',
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if ($user) {
            return redirect()->route('login')->with('success-register', 'Successfully registered, please login.');
        } else {
            return redirect()->router('register')->withErrors();
        }
    }
}
