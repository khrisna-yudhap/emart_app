<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => "Dashboard Admin | E-Mart",
            'pageIndex' => 0
        ]);
    }

    public function users_view()
    {
        $users = User::get();

        $totalUsers = count($users);


        return view('users', [
            'title' => "Users Management | E-Mart",
            'pageIndex' => 1,
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);

        $user->softDeletes();
    }
}
