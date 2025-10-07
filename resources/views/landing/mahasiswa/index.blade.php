@extends('landing.layout.app')

@section('style')
    <style>
        /* h1 {
                                                            color: red;
                                                        } */
    </style>
@endsection

@section('content')
    <div class="flex flex-col">
        <a href="{{ Route('mahasiswa.create') }}">Tambah Data</a>
        <table border="1" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>
                            <a href="{{ Route('mahasiswa.edit', $item->id) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ Route('mahasiswa.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    {{-- <script>
        function tampilkanPesan() {
            alert("hello bro");
        }
    </script> --}}
@endsection
