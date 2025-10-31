@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-10 max-w-2xl">

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Tambah Produk</h2>

            <form action="{{ url('mbah-oerip/product/store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama Produk</label>
                    <input type="text" name="name"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Gambar Produk</label>
                    <input type="file" name="image" class="w-full text-gray-600">
                </div>

                <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition text-white font-semibold rounded-lg">
                    Simpan Produk
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ url('mbah-oerip/product/list') }}" class="text-blue-600 hover:underline">
                    Lihat Daftar Produk →
                </a>
            </div>
        </div>

    </div>
@endsection
