<div class="p-5">
    <a href="https://flowbite.com/" class="flex items-center pl-2">
        <img src="{{ asset('assets/img/logo.png')}}" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
        <span class="self-center text-3xl font-semibold whitespace-nowrap hover:text-blue-700">SMP</span>
    </a>
</div>
<div class="p-4 mt-2">
    <ul class="space-y-2 font-semibold">
        <li>
            <a href="{{ route('dashboard') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'dashboard') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>  
                <span class="ms-3">Dashboard</span>
            </a>
        </li>
        <li class="relative">
            <a href="#" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'tim' || Route::currentRouteName() == 'atlet') text-blue-700 @endif" aria-controls="dropdown-example" data-collapse-toggle="mainmenu">
                <svg class="w-6 h-6 transition duration-75" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <span class="ms-3">Master Data</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-3 h-3 ml-auto">
                    <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
            <ul class="hidden text-gray-600 pt-1 w-48 rounded-lg" id="mainmenu">
                <li>
                    <a href="{{ route('tim') }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap 
                    @if (Route::currentRouteName() == 'tim') text-blue-700 @endif">
                        <span class="ms-6">Data Tim</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('atlet') }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap 
                    @if (Route::currentRouteName() == 'atlet') text-blue-700 @endif">
                        <span class="ms-6">Data Atlet</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user') }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap 
                    @if (Route::currentRouteName() == 'user') text-blue-700 @endif">
                        <span class="ms-6">Data User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap 
                    @if (Route::currentRouteName() == 'kelas') text-blue-700 @endif">
                        <span class="ms-6">Data Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwal') }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap 
                    @if (Route::currentRouteName() == 'jadwal') text-blue-700 @endif">
                        <span class="ms-6">Data Jadwal</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('pembayaran') }}" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'pembayaran') text-blue-700 @endif">
                <svg class="w-6 h-6 transition duration-75" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
                <span class="ms-3">Payment</span>
            </a>
        </li>
    </ul>

    <ul class="absolute bottom-5 left-0 space-y-2 font-semibold w-[250px] px-4 py-4">
        <li class="relative">
            <a href="#" class="hover:text-gray-500 flex items-center p-2 rounded-lg group @if (Route::currentRouteName() == 'profile' || Route::currentRouteName() == 'change.password') text-blue-700 @endif" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <svg class="w-6 h-6 transition duration-75" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="ms-3">Pengaturan</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-3 h-3 ml-auto">
                    <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
            <ul class="hidden text-gray-600 pt-1 w-48 rounded-lg" id="dropdown-example">
                <li>
                    <a href="{{ route('profile', Auth::user()->id) }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap @if (Route::currentRouteName() == 'profile') text-blue-700 @endif">
                        <span class="ms-6">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('change.password', Auth::user()->id) }}" class="flex hover:bg-gray-300 py-2 px-4 whitespace-no-wrap @if (Route::currentRouteName() == 'change.password') text-blue-700 @endif">
                        <span class="ms-6">Ganti Password</span>
                    </a>
                </li>
            </ul>
        </li>                    
        <li>
            <li>
                <a href="#" class="text-red-700 hover:text-red-500 flex items-center p-2 rounded-lg group" onclick="event.preventDefault(); Logout();">
                    <svg class="w-6 h-6 transition duration-75" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </li>
    </ul>
</div>