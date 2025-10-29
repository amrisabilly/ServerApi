<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\Order_items;

class OrderItemsController extends Controller
{
    // Tampilkan semua order items
    public function index()
    {
        $items = Order_items::with(['order', 'product'])->get();
        return response()->json($items);
    }

    // Simpan order item baru
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:table_orders,id',
            'product_id' => 'required|exists:product,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $item = Order_items::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price' => $request->price,
        ]);

        return response()->json($item, 201);
    }

    // Tampilkan detail order item
    public function show($id)
    {
        $item = Order_items::with(['order', 'product'])->findOrFail($id);
        return response()->json($item);
    }

    // Update order item
    public function update(Request $request, $id)
    {
        $item = Order_items::findOrFail($id);

        $request->validate([
            'order_id' => 'sometimes|exists:table_orders,id',
            'product_id' => 'sometimes|exists:product,id',
            'qty' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
        ]);

        $item->update($request->only(['order_id', 'product_id', 'qty', 'price']));

        return response()->json($item);
    }

    // Hapus order item
    public function destroy($id)
    {
        $item = Order_items::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Order item deleted']);
    }
}
