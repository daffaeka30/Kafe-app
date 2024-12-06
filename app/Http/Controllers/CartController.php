<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Backend\Product;

class CartController extends Controller
{
    public function index()
    {
        // Ambil semua item keranjang untuk pengguna yang sedang login
        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,name',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::where('name', $request->product_id)->first();

        Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
