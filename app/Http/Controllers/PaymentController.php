<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Backend\Tax;
use Illuminate\Http\Request;
use App\Models\Backend\Order;
use PhpParser\Node\Scalar\Float_;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_3DS', true);
    }
    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Calculate total price
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity; // Assuming each cart item has a product with a price
        });

        $tax = Tax::where('name', 'PPN')->first();


        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'payment_amount' => $totalPrice + ($totalPrice * (floatval($tax->getRatePercentageAttribute()) / 100)),
            'subtotal' => $totalPrice + ($totalPrice * (floatval($tax->getRatePercentageAttribute()) / 100)),
            'tax_amount' => $totalPrice * (floatval($tax->getRatePercentageAttribute()) / 100),
            'discount_amount' => 0,
        ]);


        $midtrans = new Snap;
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = $midtrans::getSnapToken($params);

        return view('checkout', compact('snapToken'));
    }

    public function callback(Request $request)
    {
        // Validate the signature
        $serverKey = config('midtrans.server_key');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        // Update order status based on transaction status
        $order = Order::find($request->order_id);
        if ($request->transaction_status == 'settlement') {
            $order->update(['payment_status' => 'paid']);
        } else {
            // Handle other statuses (pending, failed, etc.)
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}
