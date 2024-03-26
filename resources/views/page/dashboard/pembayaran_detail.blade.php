@extends('layout.app')

@section('content')

<div class="lg:px-40 md:px-10">
    <div class="bg-white rounded-lg shadow-xl">
        <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">Order Detail</h1>
        </div>
        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <p class="text-lg font-semibold text-gray-700">Order ID:</p>
                <p class="text-gray-800">{{ $data['detail']->id }}</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">Status:</p>
                <p class="text-gray-800">{{ $data['detail']->status_pembayaran }}</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">Manager Name:</p>
                <p class="text-gray-800">{{ $data['detail']->tim->user->nama}}</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">Total Amount:</p>
                <p class="text-gray-800">{{ $data['detail']->total_pembayaran}}</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">Ordered At:</p>
                <p class="text-gray-800">{{ $data['detail']->created_at}}</p>
            </div>
            <div class="col-span-2">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">List Atlet</h2>
                <ul>
                    @foreach($data['listAtlet'] as $atlet)
                    <li class="mb-2">
                        <p class="text-gray-800">{{ $atlet->atlet->nama }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-span-2">
                @if($data['detail']->status_pembayaran === 'success')
                <button disabled class="bg-gray-300 text-white font-bold py-2 px-4 rounded">
                    Sudah Bayar
                </button>
                @else
                <button id="payButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Bayar
                </button>
                @endif
            </div>            
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        function handlePayment() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: '{{ route('pembayaran.manager.detail', ['idTeam' => $data['detail']->id_tim, 'idPertandingan' => $data['detail']->id_pertandingan]) }}',
                method: 'POST',
                data: {
                    total_pembayaran: {{ $data['detail']->total_pembayaran }},
                },
                success: function(response) {
                    window.snap.pay(response, {
                        onSuccess: function(result){
                            updatePaymentStatus(result);
                        },
                        onPending: function(result){
                            alert("Payment pending!"); console.log(result);
                        },
                        onError: function(result){
                            alert("Payment failed!"); console.log(result);
                        },
                        onClose: function(){
                            alert('Payment pop-up closed without finishing the payment');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $('#payButton').click(function() {
            handlePayment();
        });

        function updatePaymentStatus(result) {
            $.ajax({
                url: '{{ route('pembayaran.manager.detail.callback', ['idTeam' => $data['detail']->id_tim, 'idPertandingan' => $data['detail']->id_pertandingan]) }}',
                method: 'POST',
                data: {
                    status: 'success',
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>

@endSection


