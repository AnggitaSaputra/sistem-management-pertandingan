@extends('layout.app')

@section('content')

<div class="shadow-lg p-5 rounded-lg">
    <form id="profileForm">
        @csrf
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan Nama Lengkap" required />
        </div> 
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan Email" required />
        </div> 
        <div class="mb-6">
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
            <input type="text" id="role" name="role" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan Email" disabled required />
        </div> 
        <button type="button" onclick="updateProfile()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>    
</div>

@endsection

@section('script')

<script>
    function updateProfile() {
        var formData = new FormData(document.getElementById("profileForm"));
        $.ajax({
            url: '{{ route('profile', Auth::user()->id) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                fetchData();
            },
            error: function(error) {
                console.error('Error getting data:', error.responseText);
            }
        });
    }

    function fetchData() {
        $.ajax({
            url: '{{ route('profile', Auth::user()->id) }}',
            type: 'GET',
            success: function(response) {
                document.getElementById("nama").value = response.nama;
                document.getElementById("email").value = response.email;
                document.getElementById("role").value = response.role;
            },
            error: function(error) {
                console.error('Error getting data:', error.responseText);
            }
        });
    }

    window.onload = function() {
        fetchData();
    }
</script>

@endSection