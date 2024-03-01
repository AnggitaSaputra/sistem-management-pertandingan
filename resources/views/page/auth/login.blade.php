@extends('layout.app')

@section('content')
   <form id="formLogin">
        @csrf
        <input type="email" name="email" id="email" placeholder="masukkan email">
        <input type="password" name="password" id="password" placeholder="masukkan password">
        <button type="button" onclick="loginUser()">Login</button>
    </form>
    <a href="{{ route('register') }}">Register</a>
    @if(session('error'))
                    <div class="rounded-lg p-2 w-full bg-red-500 text-white flex justify-between">
                        <p>
                            {{ session('error') }}
                        </p>
                        <button type="button" class="text-white" onclick="this.parentElement.style.display='none'">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
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