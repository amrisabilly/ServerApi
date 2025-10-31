@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ url('/mbah-oerip/product/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-6 inline-block">
            + Tambah Produk
        </a>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
            @foreach ($data as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('images/mbah-oerip/' . $item->image) }}" alt="image"
                        class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-2">{{ $item->name }}</h2>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
