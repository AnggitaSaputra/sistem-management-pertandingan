<div class="p-4">
    <a href="https://flowbite.com/" class="flex items-center pl-2">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
        <span class="self-center text-3xl font-semibold whitespace-nowrap">SMP</span>
    </a>
</div>
<div class="p-4 mt-2">
    <ul class="space-y-2 font-semibold">
        <li>
            <a href="{{ route('dashboard') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'dashboard') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tim') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'tim') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                </svg>
                <span class="ms-3">Data Tim</span>
            </a>
        </li>
        <li>
            <a href="{{ route('atlet') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'atlet') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>  
                <span class="ms-3">Data Atlit</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kelas') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'kelas') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5.005 10.19a1 1 0 0 1 1 1v.233l5.998 3.464L18 11.423v-.232a1 1 0 1 1 2 0V12a1 1 0 0 1-.5.866l-6.997 4.042a1 1 0 0 1-1 0l-6.998-4.042a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1ZM5 15.15a1 1 0 0 1 1 1v.232l5.997 3.464 5.998-3.464v-.232a1 1 0 1 1 2 0v.81a1 1 0 0 1-.5.865l-6.998 4.042a1 1 0 0 1-1 0L4.5 17.824a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                    <path d="M12.503 2.134a1 1 0 0 0-1 0L4.501 6.17A1 1 0 0 0 4.5 7.902l7.002 4.047a1 1 0 0 0 1 0l6.998-4.04a1 1 0 0 0 0-1.732l-6.997-4.042Z"/>
                </svg>  
                <span class="ms-3">Data Kelas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('jadwal') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'jadwal') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="ms-3">Data Jadwal Pertandingan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pembayaran') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'pembayaran') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z"/>
                </svg>  
                <span class="ms-3">Data Payment</span>
            </a>
        </li>
    </ul>
    
    <ul class="absolute bottom-5 left-0 space-y-2 font-semibold w-[250px] px-4 py-4">
        <li class="relative">
            <a href="#" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'profile' || Route::currentRouteName() == 'change.password') text-blue-700 @endif" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <svg class="w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4"/>
                </svg>
                <span class="ms-3">Pengaturan</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-3 h-3 ml-auto">
                    <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
                
            </a>
            <ul class="hidden text-gray-600 pt-1 w-48 rounded-lg" id="dropdown-example">
                <li><a href="{{ route('profile', Auth::user()->id) }}" class="hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap @if (Route::currentRouteName() == 'profile') text-blue-700 @endif">Profile</a></li>
                <li><a href="{{ route('change.password', Auth::user()->id) }}" class="hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap @if (Route::currentRouteName() == 'change.password') text-blue-700 @endif">Change Password</a></li>
            </ul>
        </li>                    
        <li>
            <li>
                <a href="#" class="text-red-700 hover:text-red-500 flex items-center p-2 rounded-lg group" onclick="event.preventDefault(); Logout();">
                    <svg class="flex-shrink-0 w-5 h-5 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </li>
    </ul>
</div>