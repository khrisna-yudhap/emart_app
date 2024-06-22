<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class PageController extends Controller
{
    public function index()
    {
        $cartItemTotal = 0;

        if (Auth()->check()) {
            $user_id = Auth()->user()->id;
            $cartItemTotal = count(Cart::where(['user_id' => $user_id, 'status' => 'unpaid'])->get());
        }

        $products = Product::where(['is_active' => 1])->get();


        return view('welcome', [
            'title' => "E-Mart | Shopping Everyday",
            'products' => $products,
            'cartItemTotal' => $cartItemTotal
        ]);
    }
}
