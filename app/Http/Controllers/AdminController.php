<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $totalUser = User::count();

        return view('dashboard', [
            'title' => "Dashboard Admin | E-Mart",
            'pageIndex' => 0,
            'totalCategory' => $totalCategory,
            'totalProduct' => $totalProduct,
            'totalUser' => $totalUser,
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

        $user->delete();
        return redirect()->route('admin.users');
    }
}
