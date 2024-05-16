@extends('layout.app')

@section('content')

<div class="lg:px-40 md:px-10">
    <div class="block w-full my-5 p-6 bg-white shadow-xl rounded-lg">
        <div class="flex justify-between">
            <h5 class="mb-2 text-2xl font-bold tracking-tight" id="namaPertandingan"></h5>
            <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
        <p id="countdown" class="font-thin text-2xl"></p>
    </div>
    
    @if (Auth::user()->role === 'admin')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 text-gray-600">
        <a href="{{ route('user') }}" class="block max-w-lg p-6 bg-[#7BD3EA] shadow-xl rounded-lg">
            <div class="flex justify-between">
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">User</h5>
                <svg class="w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M7.1 20A3.1 3.1 0 0 1 4 16.9v-12c0-.5.4-.9.9-.9h4.4c.5 0 1 .4 1 .9v12c0 1.7-1.5 3.1-3.2 3.1Zm0 0h12c.5 0 .9-.4.9-.9v-4.4c0-.5-.4-1-.9-1h-4.4l-.6.3-3.8 3.7-.1.2c-.9 1.4-1.6 1.8-3 2.1Zm0-3.6h0m8-10.9 3.1 3.2c.3.3.3.9 0 1.2l-8 8V9l3.6-3.6c.3-.3 1-.3 1.3 0Z"/>
                </svg>
            </div>
            <p class="font-bold text-2xl ">{{ $data['user'] }}</p>
        </a>  
        <a href="{{ route('tim') }}" class="block max-w-lg p-6 bg-[#A1EEBD] shadow-xl rounded-lg">
            <div class="flex justify-between">
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">Tim</h5>
                <svg class="w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                </svg>
            </div>
            <p class="font-bold text-2xl ">{{ $data['tim'] }}</p>
        </a>  
        <a href="{{ route('atlet') }}" class="block max-w-lg p-6 bg-[#F6F7C4] shadow-xl rounded-lg">
            <div class="flex justify-between">
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">Atlit</h5>
                <svg class="w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
            </div>
            <p class="font-bold text-2xl ">{{ $data['atlit'] }}</p>
        </a> 
    </div>
    @elseif (Auth::user()->role === 'manager')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 text-black justify-center">
        <a href="{{ route('my.Tim') }}" class="min-w-lg p-6 bg-white shadow-xl rounded-lg flex justify-between items-center px-20">
            <svg class="w-32 h-32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">My Team</h5>
            </div>
        </a>  
        <a href="{{ route('my.Atlet') }}" class="min-w-lg p-6 bg-white shadow-xl rounded-lg flex justify-between items-center px-20">
            <svg class="w-32 h-32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">Total Atlet</h5>
                <p class="text-2xl font-semibold">{{ $data['atlit'] }}</p>
            </div>
        </a>  
    </div>  
    
    <div class="block w-full my-5 p-6 bg-white shadow-xl rounded-lg">
        <h1 class="font-semibold mb-5">Pemberitahuan</h1>
        <div class="grid grid-cols-1 gap-5 text-black justify-center">
            <div class="bg-blue-500 text-white shadow-md rounded-lg p-5 hover:bg-blue-600">
                <div class="flex justify-between items-center">
                    <p class="font-thin">
                        Pertandingan akan segera dimulai!
                    </p>
                    <a href="#">
                        &times;
                    </a>
                </div>
            </div>
            <div class="bg-yellow-500 text-white shadow-md rounded-lg p-5 hover:bg-yellow-600">
                <div class="flex justify-between items-center">
                    <p class="font-thin">
                        Anda belum melakukan pembayaran!
                    </p>
                    <a href="#">
                        &times;
                    </a>
                </div>
            </div>
            <div class="bg-red-500 text-white shadow-md rounded-lg p-5 hover:bg-red-600">
                <div class="flex justify-between items-center">
                    <p class="font-thin">
                        Pembayaran telah lewat! silahkan ikuti pertandingan selanjutnya.
                    </p>
                    <a href="#">
                        &times;
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    @endif
</div>

@endsection

@section('script')

<script>
    function fetchNearestTime() {
        $.ajax({
            url: "{{ route('get.jadwal') }}",
            type: "GET",
            success: function(response) {
                var nearestTime = new Date(response.nearestDate);
                var namaPertandinganElement = document.getElementById("namaPertandingan");
                namaPertandinganElement.textContent = `Hitung Mundur ${response.namaPertandingan}`;
                setInterval(function() {
                    updateCountdown(nearestTime);
                }, 1000);
            },
            error: function(error) {
                console.error('Error fetching nearest time:', error.responseText);
            }
        });
    }

    function updateCountdown(nearestTime) {
        var now = new Date();
        var timeDiff = nearestTime.getTime() - now.getTime();
        
        var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
        
        document.getElementById('countdown').innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
    }

    fetchNearestTime();
</script>

@endSection()