@extends('layout.app')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <a href="#" class="block max-w-lg p-6 bg-[#7BD3EA] text-gray-900 border border-black shadow-xl rounded-lg">
        <div class="flex justify-between">
            <h5 class="mb-2 text-2xl font-bold tracking-tight ">User</h5>
            <svg class="w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M7.1 20A3.1 3.1 0 0 1 4 16.9v-12c0-.5.4-.9.9-.9h4.4c.5 0 1 .4 1 .9v12c0 1.7-1.5 3.1-3.2 3.1Zm0 0h12c.5 0 .9-.4.9-.9v-4.4c0-.5-.4-1-.9-1h-4.4l-.6.3-3.8 3.7-.1.2c-.9 1.4-1.6 1.8-3 2.1Zm0-3.6h0m8-10.9 3.1 3.2c.3.3.3.9 0 1.2l-8 8V9l3.6-3.6c.3-.3 1-.3 1.3 0Z"/>
            </svg>
        </div>
        <p class="font-bold text-2xl ">{{ $data['user'] }}</p>
    </a>  
    <a href="#" class="block max-w-lg p-6 bg-[#A1EEBD] text-gray-900 border border-black shadow-xl rounded-lg">
        <div class="flex justify-between">
            <h5 class="mb-2 text-2xl font-bold tracking-tight ">Tim</h5>
            <svg class="w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
            </svg>
        </div>
        <p class="font-bold text-2xl ">{{ $data['tim'] }}</p>
    </a>  
    <a href="#" class="block max-w-lg p-6 bg-[#F6F7C4] text-gray-900 border border-black shadow-xl rounded-lg">
        <div class="flex justify-between">
            <h5 class="mb-2 text-2xl font-bold tracking-tight ">Atlit</h5>
            <svg class="w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
        </div>
        <p class="font-bold text-2xl ">{{ $data['atlit'] }}</p>
    </a> 
</div>

@endsection