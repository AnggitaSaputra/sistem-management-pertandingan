@extends('layout.app')

@section('content')
<div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">Daftar Kelas</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @if($data['classes'])
            @foreach($data['classes'] as $class)
            <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-2">{{ $data['classes']->nama_kelas }}</h2>
                <p class="text-gray-700 mb-2">Kategori: {{ $data['classes']->kategori }}</p>
                <p class="text-gray-700 mb-2">Berat Badan: {{ $data['classes']->bb }}</p>
                <div class="flex justify-end">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
                </div>
            </div>
            @endforeach
        @else
        <p>No classes available</p>
        @endif
    </div>
</div>
@endsection
