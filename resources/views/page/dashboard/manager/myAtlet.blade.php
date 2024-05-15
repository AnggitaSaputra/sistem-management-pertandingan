@extends('layout.app')

@section('content')
<div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <h1 class="text-l font-semibold mb-4">Daftar Atlet</h1>
    <div class="pb-4 bg-white flex justify-between">
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
        </div>
        <div>
            <button id="openModalButton" class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-lg">
                Tambah Data
            </button>
        </div>
    </div>
    <div id="atletModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold">Tambah {{$data['title'] }}</h2>
                <button id="closeModalButton" class="text-red-500 hover:text-red-700">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formAtlet" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Nama</label>
                        <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Nama" required />
                        <input type="id" id="id" name="id" hidden>
                    </div> 
                    <div class="mb-6">
                        <label for="ttl" class="block mb-2 text-sm font-medium text-gray-900">Asal Institusi</label>
                        <input type="text" id="ttl" name="ttl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan TTL" required />
                    </div> 
                    <div class="mb-6">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected value="">Pilih jenis kelamin</option>
                            <option value="perempuan">Perempuan</option>
                            <option value="laki-laki">Laki-Laki</option>
                        </select>
                    </div> 
                    <div class="mb-6">
                        <label for="berat_badan" class="block mb-2 text-sm font-medium text-gray-900">Berat Badan</label>
                        <input type="number" id="berat_badan" name="berat_badan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Berat Badan" required>
                    </div> 
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Foto Diri</label>
                        <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto" id="foto" type="file" required>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="foto_atlet">.PNG , .JPG, .JPEG</p>
                    </div> 
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Foto KTP</label>
                        <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto_ktp" id="foto_ktp" type="file" required>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="foto_atlet">.PNG , .JPG, .JPEG</p>
                    </div> 
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Ijazah Terakhir Karate</label>
                        <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-artikelnter bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="ijazah_karate" id="ijazah_karate" type="file" required>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="surat_tugas">.PNG , .JPG, .JPEG, .PDF</p>
                    </div> 
                    <button type="button" onclick="saveAtlet()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat Badan</th>
                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Delete</span></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data['atlet'] as $atlet)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $data['atlet']->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $data['atlet']->ttl }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $data['atlet']->jenis_kelamin }}</td>Z
                <td class="px-6 py-4 whitespace-nowrap">{{ $data['atlet']->berat_badan }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
