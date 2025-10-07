@extends('landing.layout.app')

@section('style')
    <style>
        /* h1 {
                                        color: red;
                                    } */
    </style>
@endsection

@section('content')
    <div>
        <form action="{{ Route('mahasiswa.store') }}" method="post" class="flex flex-col items-center gap-3">
            @csrf
            <div>
                <label for="">Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="border-2">
            </div>
            <div>
                <label for="">Nim</label>
                <input type="number" name="nim" placeholder="Nim" class="border-2">
            </div>
            <button type="submit" class="bg-blue-800 text-white">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    {{-- <script>
        function tampilkanPesan() {
            alert("hello bro");
        }
    </script> --}}
@endsection
