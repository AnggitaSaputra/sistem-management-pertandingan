@extends('layout.app')

@section('content')

<div class="lg:px-40 md:px-10">
    <div class="shadow-lg p-5 rounded-lg bg-white">
        <form id="passwordForm">
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Password Lama</label>
                <input type="password" id="password_lama" name="password_lama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Password Lama" required />
            </div> 
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Password Baru</label>
                <input type="password" id="password_baru" name="password_baru" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Password Baru" required />
            </div> 
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password Baru</label>
                <input type="password" id="password_baru_konfirmasi" name="password_baru_konfirmasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Konfirmasi Password Baru" required />
            </div> 
            <button type="button" onclick="updatePassword()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
        </form>    
    </div>
</div>

@endsection

@section('script')

<script>
    function updatePassword() {
        var formData = new FormData(document.getElementById("passwordForm"));
        $.ajax({
            url: '{{ route('change.password', Auth::user()->id) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                document.getElementById("passwordForm").reset();
                alert(response);
            },
            error: function(error) {
                console.error('Error getting data:', error.responseText);
            }
        });
    }
</script>

@endSection