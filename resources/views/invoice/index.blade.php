@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Invoice Pembelian</h2>
    
    @if(empty($cart))
        <p>Your cart is empty. Please checkout first.</p>
    @else
        <h4>Informasi Pengiriman</h4>
        <p><strong>Nama:</strong> {{ $shippingInfo->customer_name }}</p>
        <p><strong>Alamat:</strong> {{ $shippingInfo->customer_address }}</p>
        <p><strong>Kota:</strong> {{ $shippingInfo->customer_city }}</p>
        <p><strong>Kode Pos:</strong> {{ $shippingInfo->customer_pos_code }}</p>
        <p><strong>Nomor Telepon:</strong> {{ $shippingInfo->customer_phone }}</p>

        <h4>Rincian Pesanan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
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
                        <td>{{ $item['title'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total Keseluruhan (Rp): 
            <span id="total">
                {{ number_format($total, 0, ',', '.') }}
            </span>
        </h4>

        <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali ke Beranda</a>
    @endif
</div>

<br>
<br>

@endsection