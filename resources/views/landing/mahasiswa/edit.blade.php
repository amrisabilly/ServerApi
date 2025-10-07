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
        <form action="{{ Route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="flex flex-col items-center gap-3">
            @csrf
            @method('PUT')
            <div>
                <label for="">Nama</label>
                <input type="text" name="nama" value="{{ $mahasiswa->nama }}" placeholder="Nama" class="border-2">
            </div>
            <div>
                <label for="">Nim</label>
                <input type="number" name="nim" value="{{ $mahasiswa->nim }}" placeholder="Nim" class="border-2">
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
