<?php

namespace App\Http\Controllers\Api\AplikasiCoffe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AplikasiCoffe\Orders;
use App\Models\AplikasiCoffe\Order_items;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with(['user', 'items.product'])->get();
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:table_user,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:product,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Hitung total
        $total = collect($request->items)->sum(function ($item) {
            return $item['qty'] * $item['price'];
        });

        // Simpan order
        $order = Orders::create([
            'user_id' => $request->user_id,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Simpan order items
        foreach ($request->items as $item) {
            Order_items::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        return response()->json($order->load(['items.product']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Orders::with(['user', 'items.product'])->findOrFail($id);
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Orders::findOrFail($id);
        $request->validate([
            'status' => 'required|string',
        ]);
        $order->update([
            'status' => $request->status,
        ]);
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Orders::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }
}
