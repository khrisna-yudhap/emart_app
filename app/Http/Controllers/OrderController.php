<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
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
        $invoice_id = 'INV/E-MART-' . date('Ymd') . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);

        $user_id = $validatedData['user_id'];
        $total_price = $validatedData['total_price'];
        $cartItemTotal = count(Cart::where(['user_id' => $user_id])->get());

        $order = Order::create([
            'invoice_id' => $invoice_id,
            'user_id' => $user_id,
            'total_price' => $total_price,
        ]);

        $user = User::find($user_id);

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
                'order_id' => $order->invoice_id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );

        $data = [
            'userData' => $user,
            'cartItemTotal' => $cartItemTotal,
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // $this->payment($invoice_id, $data);
    }

    public function payment($invoice_id, $data)
    {
        return redirect()->route('order.payment', ['invoice_id' => $invoice_id]);
    }
}
