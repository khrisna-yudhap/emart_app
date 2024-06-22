<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;


class AdminController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $totalUser = User::count();
        $orders = Order::leftJoin('users', 'users.id', '=', 'orders.user_id')->orderBy('invoice_id', 'DESC')->get(['orders.id', 'orders.invoice_id', 'first_name', 'last_name', 'email', 'phone', 'orders.status', 'orders.created_at', 'total_price']);

        return view('dashboard', [
            'title' => "Dashboard Admin | E-Mart",
            'pageIndex' => 0,
            'totalCategory' => $totalCategory,
            'totalProduct' => $totalProduct,
            'totalUser' => $totalUser,
            'totalOrder' => count($orders),
            'pendingOrder' => count($orders->where(['status'] == 'unpaid')),
            'orders' => $orders
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

    public function order_detail($id)
    {
        $orderData = Order::where(['id' => $id])->first();
        $cartData = Cart::where(['invoice_id' => $orderData->invoice_id])->leftJoin('products', 'products.id', '=', 'carts.product_id')->get();
        $userData = User::where(['id' => $orderData->user_id])->first();

        $subTotal = 0;
        $subTotal = $cartData->sum('item_price');

        return view('order_details', [
            'title' => "Order Details | E-Mart",
            'pageIndex' => 0,
            'orderData' => $orderData,
            'cartData' => $cartData,
            'userData' => $userData,
            'subTotal' => $subTotal
        ]);
    }
}
