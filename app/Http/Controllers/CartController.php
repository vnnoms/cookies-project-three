<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{ public function add(Request $request, Item $item)
    {
        if ($item->stock < 1) {
            return back()->with('error', 'Product is out of stock.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            if ($cart[$item->id]['quantity'] >= $item->stock) {
                return back()->with('error', 'Stock limit reached.');
            }

            $cart[$item->id]['quantity']++;
        } else {
            $cart[$item->id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$item->id])) {
            return back()->with('error', 'Product not found in cart.');
        }

        if ($request->quantity > $item->stock) {
            return back()->with('error', 'Quantity exceeds available stock.');
        }

        $cart[$item->id]['quantity'] = (int) $request->quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove(Item $item)
    {
        $cart = session()->get('cart', []);

        unset($cart[$item->id]);

        session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }
}