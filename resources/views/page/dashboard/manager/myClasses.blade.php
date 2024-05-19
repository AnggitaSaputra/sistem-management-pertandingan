@extends('layout.app')

@section('content')

@extends('layout.app')

@section('content')
<div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold mb-4 text-center">Classes</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @if(isset($data['classes']) && count($data['classes']) > 0)
            @foreach($data['classes'] as $class)
            <div class="bg-white p-4 rounded-lg shadow-lg">               
                <img src="{{ asset($class->image_url) }}" alt="{{ $class->nama_kelas }}" class="w-full h-40 object-cover rounded-t-lg">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $class->nama_kelas }}</h2>
                    <p class="text-gray-700 mb-2">{{ $class->kategori }}</p>
                    <p class="text-gray-700 mb-2">{{ $class->bb }}</p>
                    <div class="flex justify-between items-center">
                        <p class="text-gray-700">Your Athletes: 0</p>
                        <a href="#" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
                <img src="{{ $class->image_url }}" alt="{{ $class->nama_kelas }}" class="w-full mb-4">
                <h2 class="text-xl font-semibold mb-2">{{ $class->nama_kelas }}</h2>
                <p class="text-gray-700 mb-2">Kategori: {{ $class->kategori }}</p>
                <p class="text-gray-700 mb-2">Berat Badan: {{ $class->bb }}</p>
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

{{-- <div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">Daftar Kelas</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Kata Individu Putra</h2>
        <p class="text-gray-700 mb-2">Kategori: -</p>
        <p class="text-gray-700 mb-2">Berat Badan: -</p>
        <div class="flex justify-end">
          <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
        </div>
      </div>
  
      <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Kata Individu Putri</h2>
        <p class="text-gray-700 mb-2">Kategori: -</p>
        <p class="text-gray-700 mb-2">Berat Badan: -</p>
        <div class="flex justify-end">
          <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
        </div>
      </div>
  
      <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Kata Beregu Putra</h2>
        <p class="text-gray-700 mb-2">Kategori: -</p>
        <p class="text-gray-700 mb-2">Berat Badan: -</p>
        <div class="flex justify-end">
          <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
        </div>
      </div>
  
      <div class="bg-gray-200 p-4 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-2">Kata Beregu Putri</h2>
        <p class="text-gray-700 mb-2">Kategori: -</p>
        <p class="text-gray-700 mb-2">Berat Badan: -</p>
        <div class="flex justify-end">
          <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
        </div>
      </div> --}}
  
@endsection
