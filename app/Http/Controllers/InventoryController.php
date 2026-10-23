<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InventoryController extends Controller
{
    // Show inventory admin and staff
    public function index(): View
    {
        $items = Item::orderBy('name')->get();

        return view('products.inventory', compact('items'));
    }

    // Change products: Only admin
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        Item::create($validated);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Change stocks: admin and staff
    public function updateStock(
        Request $request,
        Item $item
    ): RedirectResponse {
        $validated = $request->validate([
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:1000000',
            ],
        ]);

        $item->stock = $validated['stock'];
        $item->save();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }
}
