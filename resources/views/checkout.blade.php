@extends('layouts.app')

@section('content')
    <div class="container bg-light">
        <h1>Checkout</h1>
        <button id="pay-button" class="btn btn-primary d-flex">Pay Now</button>

        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
        {{-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script> --}}
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        console.log(result);
                        alert('Payment Success!');
                    },
                    onPending: function(result) {
                        console.log(result);
                        alert('Transaction Pending!');
                    },
                    onError: function(result) {
                        console.log(result);
                        alert('Transaction Failed!');
                    }
                });
            };
        </script>
    </div>
@endsection
