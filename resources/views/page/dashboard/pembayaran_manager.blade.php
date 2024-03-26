@extends('layout.app')

@section('content')

<div class="lg:px-40 md:px-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 text-black justify-center">
        <div class="min-w-lg p-6 bg-white shadow-xl rounded-lg flex justify-between px-20">
            <svg class="w-32 h-32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">Pertandingan</h5>
                @if(!empty($data['pertandingan']))
                    @if($data['checkTim'] !== null)
                    <p class="text-2xl font-thin mb-4">{{ $data['pertandingan']['namaPertandingan'] }}</p>
                    <a href="" class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-5 rounded-lg w-full">Lihat Tim Saya</a>
                    @else
                    <p class="text-2xl font-thin mb-4">{{ $data['pertandingan']['namaPertandingan'] }}</p>
                    <a href="" class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-5 rounded-lg w-full">Ikuti Pertandingan</a>
                    @endif
                @else
                    <p class="text-2xl font-thin mb-4">Tidak ada pertandingan</p>
                @endif
            </div>
        </div>  
        <div class="min-w-md p-6 bg-white shadow-xl rounded-lg flex justify-between px-20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
            </svg>
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">Tagihan</h5>
                @if ($data['tagihan'] === null)
                <p class="text-2xl font-thin mb-4">Tidak ada tagihan</p>
                @else
                <p class="text-2xl font-thin mb-4">Rp {{ number_format($data['tagihan']->total_pembayaran, 0, ',', '.') }},00</p>
                <a href="{{ route('pembayaran.manager.detail', ['idTeam' => $data['tagihan']->id_tim, 'idPertandingan' => $data['tagihan']->id_pertandingan]) }}" class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-5 rounded-lg w-full">Detail Tagihan</a>
                @endif 
            </div>
        </div>  
    </div>  
    
    <div class="block w-full my-5 p-6 bg-white shadow-xl rounded-lg">
        <h1 class="font-semibold mb-5">Riwayat Transaksi</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr class="border-b-[1px] border-gray-300">
                        <th class="text-left py-2 px-4 font-normal">ID Pembayaran</th>
                        <th class="text-left py-2 px-4 font-normal">Status Pembayaran</th>
                        <th class="text-left py-2 px-4 font-normal">Total Pembayaran</th>
                        <th class="text-left py-2 px-4 font-normal"></th>
                    </tr>
                </thead>
                <tbody>
                    @if($data['pembayaran']->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center">No transactions found.</td>
                        </tr>
                    @else
                        @foreach($data['pembayaran'] as $data)
                        <tr>
                            <td class="px-4 py-2 font-thin">#{{ $data->id }}</td>
                            <td class="px-4 py-2 font-thin">
                                @if ($data->status_pembayaran === 'success')
                                    <span class="flex">
                                        Success
                                        <span class="relative flex h-3 w-3 ml-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                        </span>
                                    </span>
                                @elseif($data->status_pembayaran === 'pending')
                                    <span class="flex">
                                        Pending
                                        <span class="relative flex h-3 w-3 ml-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                                        </span>
                                    </span>
                                @else
                                    <span class="flex">
                                        Failed
                                        <span class="relative flex h-3 w-3 ml-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                        </span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 font-thin">Rp {{ number_format($data->total_pembayaran, 0, ',', '.') }},00</td>
                            <td class="px-4 py-2 font-thin">
                                <a href="{{ route('pembayaran.manager.detail', ['idTeam' => $data->id_tim, 'idPertandingan' => $data->id_pertandingan]) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>                
            </table>
        </div>
    </div>    
</div>

@endsection

@section('script')

<script>

</script>

@endSection()