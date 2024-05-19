@extends('layout.app')

@section('content')
<div class="bg-white w-full h-fit p-5 shadow-lg rounded-lg">
    <h1 class="text-l font-semibold mb-4">Daftar Atlet</h1>
    <div class="pb-4 bg-white flex justify-between">
        <div>
            <button id="openModalButton" class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-lg">
                Tambah Data
            </button>
        </div>
    </div>
    <div id="atletModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div class="modal-content bg-white w-1/2 p-4 rounded-lg">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold" id="modalTitle">Tambah Atlet</h2>
                <button id="closeModalButton" class="text-red-500 hover:text-red-700">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formAtlet" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="mb-6">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Atlet</label>
                        <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukan Nama" required />
                    </div> 
                    <div class="mb-6">
                        <label for="ttl" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
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
                        <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto" id="foto" type="file" required>
                        <p class="mt-1 text-sm text-gray-500" id="foto_atlet">.PNG , .JPG, .JPEG</p>
                    </div> 
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Foto KTP</label>
                        <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="foto_ktp" id="foto_ktp" type="file" required>
                        <p class="mt-1 text-sm text-gray-500" id="foto_atlet">.PNG , .JPG, .JPEG</p>
                    </div> 
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Ijazah Terakhir Karate</label>
                        <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 text-gray-400 focus:outline-none placeholder-gray-400" aria-describedby="file_input_help" name="ijazah_karate" id="ijazah_karate" type="file" required>
                        <p class="mt-1 text-sm text-gray-500" id="surat_tugas">.PNG , .JPG, .JPEG, .PDF</p>
                    </div> 
                    <button type="button" onclick="saveAtlet()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200" id="table">
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
                <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->atlet->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->atlet->ttl }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->atlet->jenis_kelamin }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->atlet->berat_badan }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900" onclick="editAtlet({{ $atlet->atlet->id }})">Edit</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-red-600 hover:text-red-900" onclick="deleteAtlet({{ $atlet->atlet->id }})">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script> 

$(document).ready( function () {
    $('#table').DataTable();
} );

// Mendapatkan elemen-elemen yang dibutuhkan
const openModalButton = document.getElementById('openModalButton');
const closeModalButton = document.getElementById('closeModalButton');
const atletModal = document.getElementById('atletModal');
const formAtlet = document.getElementById('formAtlet');

// Fungsi untuk membuka modal
function openModal() {
    document.getElementById('modalTitle').innerText = 'Tambah Atlet';
    document.getElementById('formAtlet').reset();
    document.getElementById('id').value = '';
    atletModal.classList.remove('hidden');
}

// Fungsi untuk menutup modal
function closeModal() {
    atletModal.classList.add('hidden');
}

// Menambahkan event listener untuk membuka modal saat tombol diklik
openModalButton.addEventListener('click', openModal);
// Menambahkan event listener untuk menutup modal saat tombol ditutup diklik
closeModalButton.addEventListener('click', closeModal);

// Fungsi untuk mengirim data atlet baru atau memperbarui data atlet
function saveAtlet() {
    const formData = new FormData(document.getElementById("formAtlet"));
    const id = document.getElementById('id').value;
    const url = id ? `http://127.0.0.1:8000/atlet/update/${id}` : '{{ route('atlet.store') }}';

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Data berhasil disimpan');
            closeModal();
            location.reload();
        } else {
            alert('Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error saving data:', error);
    });
}

// Fungsi untuk mengedit data atlet
function editAtlet(atlet) {
    document.getElementById('modalTitle').innerText = 'Edit Atlet';
    document.getElementById('id').value = atlet.id;
    document.getElementById('nama').value = atlet.nama;
    document.getElementById('ttl').value = atlet.ttl;
    document.getElementById('jenis_kelamin').value = atlet.jenis_kelamin;
    document.getElementById('berat_badan').value = atlet.berat_badan;
    // Ensure that file inputs are cleared when editing
    document.getElementById('foto').value = '';
    document.getElementById('foto_ktp').value = '';
    document.getElementById('ijazah_karate').value = '';
    openModal();
}

// Fungsi untuk menghapus data atlet
function deleteAtlet(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        fetch(`http://127.0.0.1:8000/atlet/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil dihapus');
                location.reload();
            } else {
                alert('Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error deleting data:', error);
        });
    }
}
</script>
@endsection
