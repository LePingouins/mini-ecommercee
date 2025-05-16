<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment_type' => 'required|string|in:credit_card,paypal,cash',
        ]);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'payment_type' => $validated['payment_type'],
            'total_price' => $total,
            'items' => $cart,
        ]);

        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Order placed successfully!');
    }
}
