<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Item $item)
    {
        if ($item->stock < 1) {
            return back()->with('error', 'Product is out of stock.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            if ($cart[$item->id]['quantity'] >= $item->stock) {
                return back()->with('error', 'Maximum stock reached.');
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

        return back()->with('success', $item->name . ' added to cart!');
    }
}