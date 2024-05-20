@extends('layout.app')

@section('content')
<div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <form id="teamForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <h1 class="text-l font-semibold mb-4">My Team</h1>
                <div class="grid grid-cols-1 gap-4 bg-gray-200 p-4 rounded-lg">
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama_tim" id="name" class="mt-1 block w-full" value="{{ $data['team']?->nama_tim }}">
                    </div>
                    <div class="mb-4">
                        <label for="school" class="block text-lg font-medium text-gray-700">Asal Sekolah</label>
                        <input type="text" name="asal_institusi" id="school" class="mt-1 block w-full" value="{{ $data['team']?->asal_institusi }}">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-lg font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="address" class="mt-1 block w-full" value="{{ $data['team']?->alamat }}">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ $data['team']?->email }}">
                    </div>
                    <div class="mb-4">
                        <label for="manager" class="block text-lg font-medium text-gray-700">Manager</label>
                        <input type="text" id="manager" class="mt-1 block w-full" value="{{ $data['team']?->name }}" disabled>
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
                            <img src="{{ $data['team']?->foto_tim ? asset('uploads/' . $data['team']?->foto_tim) : 'https://via.placeholder.com/150' }}" alt="Logo Tim" class="w-full h-auto rounded-lg">
                        </div>
                        <div class="flex flex-col items-center mb-2">
                            <input type="file" name="logo" id="logo" class="mb-2">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openEditModal()">Edit</button>
                    </div>              
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
    <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
        <div class="flex justify-between">
            <h2 class="text-xl font-bold">Edit Team</h2>
            <button id="closeEditModalButton" class="text-red-500 hover:text-red-700">&times;</button>
        </div>
        <div class="modal-body">
            <form id="editTeamForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_team_id">
                <div class="mb-6">
                    <label for="edit_nama_tim" class="block mb-2 text-sm font-medium text-gray-900">Nama Tim</label>
                    <input type="text" id="edit_nama_tim" name="edit_nama_tim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div> 
                <div class="mb-6">
                    <label for="edit_asal_institusi" class="block mb-2 text-sm font-medium text-gray-900">Asal Institusi</label>
                    <input type="text" id="edit_asal_institusi" name="edit_asal_institusi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div> 
                <div class="mb-6">
                    <label for="edit_alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <input type="text" id="edit_alamat" name="edit_alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div> 
                <div class="mb-6">
                    <label for="edit_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="edit_email" name="edit_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div> 
                <div class="mb-6">
                    <label for="edit_email" class="block mb-2 text-sm font-medium text-gray-900">Manager</label>
                    <input type="email" id="edit_email" name="edit_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div> 
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Surat Tugas</label>
                    <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="edit_surat_tugas" id="edit_surat_tugas" type="file">
                    <p class="mt-1 text-sm text-gray-500" id="edit_surat_tugas_help">.PNG, .JPG, .JPEG, .PDF</p>
                </div> 
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Logo</label>
                    <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="edit_logo" id="edit_logo" type="file">
                    <p class="mt-1 text-sm text-gray-500" id="edit_logo_help">.PNG, .JPG, .JPEG</p>
                </div> 
                <button type="button" onclick="saveEditData()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
            </form>
        </div>
    </div>
</div>

<script>
</script>
@endsection
