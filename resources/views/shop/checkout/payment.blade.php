@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 text-center">
    <h1 class="text-2xl font-bold mb-8">Process Payment</h1>
    <div id="snap-container"></div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = '{{ route('shop.payment.finish') }}?order_id={{ $order->id }}&transaction_status=settlement';
        },
        onPending: function(result){
            window.location.href = '{{ route('shop.payment.finish') }}?order_id={{ $order->id }}&transaction_status=pending';
        },
        onError: function(result){
            window.location.href = '{{ route('shop.payment.finish') }}?order_id={{ $order->id }}&transaction_status=error';
        },
        onClose: function(){
            window.location.href = '{{ route('shop.payment.finish') }}?order_id={{ $order->id }}&transaction_status=close';
        }
    });
</script>
@endsection
