@extends('layout.app')

@section('content')
    <form id="formRegister">
        @csrf
        <input type="text" name="nama" id="nama" placeholder="masukkan nama">
        <input type="email" name="email" id="email" placeholder="masukkan email">
        <select name="role" id="role">
            <option value="official">Official</option>
            <option value="manager">Manager</option>
        </select>
        <input type="password" name="password" id="password" placeholder="masukkan password">
        <input type="password" name="password_konfirmasi" id="password_konfirmasi" placeholder="ketik ulang password">
        <button type="button" onclick="registerUser()">Register</button>
    </form>
    <a href="{{ route('login') }}">Login</a>
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
