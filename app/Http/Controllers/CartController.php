<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Auth()->user()->id;
        $cart_items = Cart::where(['user_id' => $user_id, 'status' => 'unpaid'])
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->get(['carts.id', 'product_id', 'item_price', 'price', 'item_quantity', 'product_name', 'product_desc', 'product_image']);

        $cartItemTotal = count(Cart::where(['user_id' => $user_id, 'status' => 'unpaid'])->get());

        $subTotal = 0;
        $subTotal = $cart_items->sum('item_price');

        $order = Order::where(['user_id' => $user_id, 'status' => 'unpaid'])->get();
        $pendingPayment = $order->isNotEmpty();

        if ($pendingPayment) {
            return redirect()->route('order.payment', ['invoice_id' => $order->first()->invoice_id]);
        } else {
            return view('carts', [
                'title' => 'My Cart | E-Mart',
                'cart_items' => $cart_items,
                'subTotal' => $subTotal,
                'cartItemTotal' => $cartItemTotal
            ]);
        }
    }

    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $product_id = $request->product_id;

        // Check if theres pending payment
        $order = Order::where(['user_id' => $user_id, 'status' => 'unpaid'])->get();
        $pendingPayment = $order->isNotEmpty();

        if ($pendingPayment) {
            return redirect()->route('order.payment', ['invoice_id' => $order->first()->invoice_id]);
        }

        $product = Product::find($product_id);
        $productExist = Cart::where(['product_id' => $product_id, 'status' => 'unpaid', 'user_id' => $user_id])->first();

        $maxOrder = $product->stock;
        $qty = $productExist != null ? $productExist->item_quantity : 1;

        if ($qty + 1 > $maxOrder) {
            return redirect()->route('index')->with('max-product-exceeded', 'There are no remaining stock in this product. Some is already in your cart.');
        }
        $price = $product->price;

        $totalPrice = $price;
        // Check if exist same product id in the cart

        if ($productExist != null) {
            $qty++;
            $totalPrice = $price * $qty;
            $productExist->item_quantity = $qty;
            $productExist->item_price = $totalPrice;
            $productExist->save();
        } else {
            $cartData = [
                'product_id' => $product_id,
                'item_price' => $totalPrice,
                'item_quantity' => $qty,
                'user_id' => $user_id
            ];
            $cart = Cart::create($cartData);
        }


        if ($productExist || $cart) {
            return redirect()->route('index')->with('add-to-cart-success', 'Product added to cart');
        } else {
            return redirect()->router('index')->withErrors();
        }
    }

    public function clear_cart(Request $request)
    {
        $user_id = $request->user_id;
        $items = Cart::where(['user_id' => $user_id, 'status' => 'unpaid'])->get();

        foreach ($items as $item) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success-clear-cart', 'Cart cleared.');
    }
}
