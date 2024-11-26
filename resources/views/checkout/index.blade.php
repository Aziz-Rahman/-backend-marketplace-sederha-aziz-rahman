@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Checkout</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <p>Your cart is empty. Please checkout first.</p>
    @else
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <h4>Shipping Information</h4>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control mb-2" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control mb-2" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control mb-2" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal code</label>
                <input type="text" class="form-control mb-2" id="postal_code" name="postal_code" required>
            </div>
            <div class="form-group">
                <label for="phone">No. Telp</label>
                <input type="text" class="form-control mb-2" id="phone" name="phone" required>
            </div>

            <br>

            <h4>Order Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Product</th>
                        <th class="text-center">Price (Rp)</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Subtotal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    @endphp
                    @foreach($cart as $productId => $item)
                    @php
                        $total += $item->price * $item->quantity;
                    @endphp
                        <tr>
                            <td>{{ $item->product->title }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>TOTAL: 
                <span id="total">
                    {{ number_format($total, 0, ',', '.') }}
                </span>
            </h4>

            <button type="submit" class="btn btn-success">Complete Payment !</button>
        </form>

        <br>
        <br>
        <br>
    @endif
</div>

<script>

</script>

@endsection