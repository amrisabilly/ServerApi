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
    public function index(Request $request)
    {
        $query = Orders::with(['user', 'items.product']);
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        $orders = $query->get();
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
            'payment_method' => 'nullable|string|max:100',
            'discount' => 'nullable|numeric|min:0',
        ]);

        // Hitung total sebelum diskon
        $total = collect($request->items)->sum(function ($item) {
            return $item['qty'] * $item['price'];
        });

        // Kurangi diskon jika ada
        $discount = $request->discount ?? 0;
        $finalTotal = $total - $discount;

        // Simpan order
        $order = Orders::create([
            'user_id' => $request->user_id,
            'total' => $finalTotal,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'discount' => $discount,
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
            'status' => 'sometimes|string',
            'payment_method' => 'sometimes|string|max:100',
            'discount' => 'sometimes|numeric|min:0',
        ]);
        $order->update($request->only(['status', 'payment_method', 'discount']));
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
