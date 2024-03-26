@extends('layout.app')

@section('content')

<div class="shadow-lg p-5 rounded-lg bg-white">
    <form id="pengaturanForm">
        @csrf
        <div class="mb-6">
            <label for="hargaPerTeam" class="block mb-2 text-sm font-medium text-gray-900">Harga Per Team</label>
            <input type="number" id="hargaPerTeam" name="harga_per_team" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan Harga Per Team" required />
        </div> 
        <div class="mb-6">
            <label for="hargaPerAtlet" class="block mb-2 text-sm font-medium text-gray-900">Harga Per Atlet</label>
            <input type="number" id="hargaPerAtlet" name="harga_per_atlet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan Harga Per Atlet" required />
        </div> 
        <button type="button" onclick="updatePengaturan()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>    
</div>

@endsection

@section('script')

<script>
    function updatePengaturan() {
        var formData = new FormData(document.getElementById("pengaturanForm"));
        $.ajax({
            url: '{{ route('pengaturan.harga') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                displayPengaturan();
            },
            error: function(error) {
                console.error('Error updating pengaturan:', error.responseText);
            }
        });
    }

    function displayPengaturan() {
        $.ajax({
            url: '{{ route('pengaturan.harga') }}',
            type: 'GET',
            success: function(response) {
                document.getElementById("hargaPerTeam").value = response.harga_per_team;
                document.getElementById("hargaPerAtlet").value = response.harga_per_atlet;
            },
            error: function(error) {
                console.error('Error fetching pengaturan:', error.responseText);
            }
        });
    }

    window.onload = function() {
        displayPengaturan();
    }
</script>

@endSection
