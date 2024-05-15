@extends('layout.app')

@section('content')
<div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <form id="teamForm" action="{{ route('myTim.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <h1 class="text-l font-semibold mb-4">My Team</h1>
                <div class="grid grid-cols-1 gap-4 bg-gray-200 p-4 rounded-lg">
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama_tim" id="name" class="mt-1 block w-full" value="{{ $data['team']->nama_tim }}">
                    </div>
                    <div class="mb-4">
                        <label for="school" class="block text-lg font-medium text-gray-700">Asal Sekolah</label>
                        <input type="text" name="asal_institusi" id="school" class="mt-1 block w-full" value="{{ $data['team']->asal_institusi }}">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-lg font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="address" class="mt-1 block w-full" value="{{ $data['team']->alamat }}">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ $data['team']->email }}">
                    </div>
                </div>
            </div>
            <div class="col-span-1 flex flex-col mt-10">
                <div class="grid grid-cols-1 gap-4 bg-gray-200 p-4 rounded-lg">
                    <div class="p-4 rounded-lg flex flex-col items-start">
                        <h2 class="text-lg font-semibold mb-4">Surat Tugas</h2>
                        <div class="flex flex-col items-center mb-2">
                            <input type="file" name="surat_tugas" id="surat_tugas" class="mb-2">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 bg-gray-200 p-4 rounded-lg mt-4">
                    <div class="p-4 rounded-lg flex flex-col items-start">
                        <h2 class="text-lg font-semibold mb-4">Logo</h2>
                        <div class="w-full">
                            <img src="{{ $data['team']->foto_tim ? asset('uploads/' . $data['team']->foto_tim) : 'https://via.placeholder.com/150' }}" alt="Logo Tim" class="w-full h-auto rounded-lg">
                        </div>
                        <div class="flex flex-col items-center mb-2">
                            <input type="file" name="logo" id="logo" class="mb-2">
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </form>
</div>

<script>
    function editData() {
        document.getElementById('teamForm').submit();
    }

    function saveData() {
        document.getElementById('teamForm').submit();
    }
</script>
@endsection
