<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <title>{{ config('app.name') }} | {{ $data['title'] }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200">
    <div class="flex h-screen">
        <div class="bg-white min-w-[250px] flex flex-col border-r-[1px] shadow-lg">
            @include('layout.partials.sidebar')
        </div>
        <div class="flex-1">
            <div class="bg-white shadow-lg border-b-[1px] p-6 flex justify-between">
                @include('layout.partials.navbar')
            </div>
            <div class="p-8">
                @yield('content')
            </div>
            <footer class="fixed bottom-0 p-5 text-gray-400 text-sm">
                © {{date('Y')}} {{ config('app.name') }}. All rights reserved.
            </footer>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script id="midtrans-script" type="text/javascript"
    src="https://app.midtrans.com/snap/snap.js"
    data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    @yield('script')
</body>
</html>