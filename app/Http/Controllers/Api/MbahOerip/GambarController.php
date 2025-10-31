<?php

namespace App\Http\Controllers\Api\MbahOerip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MbahOerip\Product;

class GambarController extends Controller
{
    public function create()
    {
        return view('mbah-oerip.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/mbah-oerip'), $imageName);

        Product::create([
            'name' => $request->name,
            'image' => $imageName
        ]);

        return redirect()->back()->with('success', 'Produk berhasil disimpan!');
    }

    public function list()
    {
        $data = Product::all();
        return view('about.index', compact('data'));
    }
}
