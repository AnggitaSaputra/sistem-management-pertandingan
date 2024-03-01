@extends('layout.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="max-w-md bg-white p-8 rounded-lg shadow-md">
        <form id="formRegister" class="mb-4">
            @csrf
            <p class="text-center text-gray-600 text-2xl mb-4">Selamat Datang</p>
            <p class="text-center text-gray-600 mb-6">Silahkan melakukan pendaftaran</p>
            <input type="text" name="nama" id="nama" placeholder="masukkan nama" class="w-full px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400">
            <input type="email" name="email" id="email" placeholder="masukkan email" class="w-full px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400">
            <select name="role" id="role" class="px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400 appearance-none">
                <option value="official" class="py-2">Official</option>
                <option value="manager" class="py-2">Manager</option>
            </select>
            <input type="password" name="password" id="password" placeholder="masukkan password"class=" w-full px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400">
            <input type="password" name="password_konfirmasi" id="password_konfirmasi" placeholder="ketik ulang password" class="w-full px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400">
            <button type="button" onclick="registerUser()" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Register</button>
        </form>
        <p class="text-center text-gray-600 mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600">Login</a></p>
    </div>
@endsection
@section('script')
    <script>
        function registerUser() {
            const password = $('#password').val();
            const passwordKonfirmasi = $('#password_konfirmasi').val();
            if (password !== passwordKonfirmasi) {
                alert('Password tidak sama!');
                return; // Add a return to prevent further execution
            }
            const formData = $('#formRegister').serialize();
            // Include CSRF token in the headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'register',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#formRegister')[0].reset();
                    alert('Register Successful!');
                    window.location.href = BASE_URL;
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Failed to register. Please try again later.');
                }
            });
        }
    </script>
@endsection
