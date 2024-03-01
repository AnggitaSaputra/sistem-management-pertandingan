@extends('layout.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="max-w-md bg-white p-8 rounded-lg shadow-md">
            <form id="formLogin" class="mb-4">
                @csrf
                <p class="text-center text-gray-600 text-2xl mb-4">Selamat Datang</p>
                <p class="text-center text-gray-600 mb-6">Login menggunakan akun anda</p>
                <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400">
                <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:border-blue-400">
                <button type="button" onclick="loginUser()" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
            </form>
            <p class="text-center text-gray-600 mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600">Daftar</a></p>
            @if(session('error'))
                <div class="rounded-lg p-2 bg-red-500 text-white flex justify-between items-center max-w-md mt-4">
                    <p>{{ session('error') }}</p>
                    <button type="button" onclick="this.parentElement.style.display='none'" class="text-white">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('script')
    <script>
        function loginUser() {
            const formData = $('#formLogin').serialize();
            // Include CSRF token in the headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#formLogin')[0].reset();
                    alert('Login Successful!');
                    window.location.href = BASE_URL + 'dashboard';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Failed to Login. Please try again later.');
                }
            });
        }
    </script>
@endsection
