<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'total_price' => 'required'
        ]);

        $lastorderId = Order::orderBy('id', 'DESC')->first()->invoice_id ?? 0;
        $lastIncreament = substr($lastorderId, -3);
        $invoice_id = 'INV-E-MART-' . date('Ymd') . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);

        $user_id = $validatedData['user_id'];
        $total_price = $validatedData['total_price'];
        $cartItemTotal = count(Cart::where(['user_id' => $user_id])->get());

        $order = Order::create([
            'invoice_id' => $invoice_id,
            'user_id' => $user_id,
            'total_price' => $total_price,
        ]);

        // Assign Invoice ID in the cart
        $cart_items = Cart::where(['user_id' => $user_id, 'status' => 'unpaid'])->get();

        foreach ($cart_items as $item) {
            $item->invoice_id = $invoice_id;
            $item->save();
        }

        return redirect()->route('order.payment', ['invoice_id' => $invoice_id]);
    }

    public function payment($invoice_id)
    {
        $order = Order::where(['invoice_id' => $invoice_id])->first();

        if ($order->status == 'paid') {
            return redirect()->route('order.invoice', ['invoice_id' => $invoice_id]);
        }

        $cart_items = Cart::where(['user_id' => $order->user_id, 'invoice_id' => $invoice_id, 'status' => 'unpaid'])
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->get(['carts.id', 'product_id', 'item_price', 'price', 'item_quantity', 'product_name', 'product_desc', 'product_image']);
        $user = User::find($order->user_id);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->invoice_id . '-' . mt_rand(1111, 9999),
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('checkout', [
            'title' => 'My Cart | E-Mart',
            'orderData' => $order,
            'cart_items' => $cart_items,
            'cartItemTotal' => count($cart_items),
            'userData' => $user,
            'subTotal' => $order->total_price,
            'snapToken' => $snapToken,
        ]);
    }

    public function payment_handler(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $order_id = $request->order_id;
        $status = $request->status_code;
        $amount = $request->gross_amount;
        $transaction_status = $request->transaction_status;
        $type = $request->payment_type;
        $fraud = $request->fraud_status;

        $hashedKey = hash("sha512", $order_id . $status . $amount . $serverKey);
        if ($hashedKey != $request->signature_key) {
            abort(404, "Invalid Signature Key");
        }

        // find order by invoice_id
        $invoice_id = mb_substr($request->order_id, 0, -5);

        $order = Order::where('invoice_id', $invoice_id)->first();
        $cart_items = Cart::where('invoice_id', $invoice_id)->get();

        if (!$order) {
            abort(404, "Order Not Found");
        }

        if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
            if ($type == 'credit_card') {
                if ($fraud == 'accept') {
                    // SET CART TO PAID
                    foreach ($cart_items as $item) {
                        // find product by id
                        $product = Product::find($item->product_id);

                        // update stock
                        $oldStock = $product->stock;
                        $newStock = $oldStock - $item->item_quantity;
                        $product->stock = $newStock;
                        $product->save();

                        // update status cart
                        $item->status = 'paid';
                        $item->save();
                    }
                    // SET ORDER TO PAID
                    $order->status = 'paid';
                    $order->save();
                }
            }
        }
    }

    public function invoice($invoice_id)
    {
        $order = Order::where(['invoice_id' => $invoice_id])->first();

        if ($order->status == 'unpaid') {
            return redirect()->route('order.payment', ['invoice_id' => $invoice_id]);
        }

        $cart_items = Cart::where(['user_id' => $order->user_id, 'invoice_id' => $invoice_id, 'status' => 'paid'])
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->get(['carts.id', 'product_id', 'item_price', 'price', 'item_quantity', 'product_name', 'product_desc', 'product_image']);
        $user = User::find($order->user_id);

        return view('invoice', [
            'title' => 'My Cart | E-Mart',
            'orderData' => $order,
            'cart_items' => $cart_items,
            'cartItemTotal' => count($cart_items),
            'userData' => $user,
            'subTotal' => $order->total_price,
        ]);
    }

    public function test_calculate()
    {
        $invoice_id = "INV-E-MART-20240622004";

        $cart_items = Cart::where('invoice_id', $invoice_id)->get();

        foreach ($cart_items as $item) {
            // find product by id
            $product = Product::find($item->product_id);

            // update stock
            $oldStock = $product->stock;
            $newStock = $oldStock - $item->item_quantity;
            $product->stock = $newStock;
            $product->save();

            // update status cart
            $item->status = 'paid';
            $item->save();
        }
    }
}
