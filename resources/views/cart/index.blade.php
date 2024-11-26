@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Product</th>
                    <th class="text-center">Price (Rp)</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Subtotal (Rp)</th>
                    <th class="text-center">Action</th>
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
                    <tr id="row-{{ $item->id }}">
                        <td>{{ $item->product->title }}</td>
                        <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            {{-- <input type="number" class="form-control" value="{{ $item->quantity }}" min="1" readonly> --}}
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary minus-btn" type="button" onclick="btnMin({{ $item->id }})">-</button>
                                </div> 
                                <input type="text" class="form-control text-center quantity-{{ $item->id }}" onchange="changeQty({{ $item->id }}, parseInt(this.value))" value="{{ $item->quantity }}" min="1" aria-label="Quantity" style="width: 20px;">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary plus-btn" type="button" onclick="btnPlus({{ $item->id }})">+</button>
                                </div>
                                <input type="hidden" class="item-total" value="{{ $item->price * $item->quantity }}">
                            </div>
                        </td>
                        <td class="text-end">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm remove-cart-item" onclick="removeCartItem({{ $item->id }})" data-id="{{ $item->id }}">
                                <i class="fa fa-remove"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class ="d-flex justify-content-between">
            <h4>TOTAL (Rp): 
                <span id="total">
                    {{ number_format($total, 0, ',', '.') }}
                </span>
            </h4>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
        </div>
    @endif
</div>

<script>
    $(document).ready(function() {

    });

    function removeCartItem(key) {

        $.ajax({
            url: '/cart/delete/'+key,
            method: 'POST',
            data: {
                cart_id: key,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {

                    // Perbarui total belanja
                    $('#total').text(formatRupiah(response.total));

                    // Hapus baris item dari tabel
                    $('#row-'+key).remove();

                } else {
                    alert(response.message);
                }
            },
            error: function(error) {
                console.error('Error removing cart item:', error);
            }
        });
    }

    function btnPlus(key) {
        let quantity = parseInt($('.quantity-'+key).val());
        $('.quantity-'+key).val(quantity + 1);

        // Ajax update qty
        updateCart(key, quantity + 1);
    }

    function btnMin(key) {
        let quantity = parseInt($('.quantity-'+key).val());
        if (quantity > 1) {
            $('.quantity-'+key).val(quantity - 1);
        }

        // Ajax update qty
        updateCart(key, quantity - 1);
    }

    // Ajax update qty
    function updateCart(key, quantity) {
        $.ajax({
            url: '/cart/'+key, 
            method: 'POST',
            data: {
                keyID: key,
                quantity: quantity,
                _token: '{{ csrf_token() }}' 
            },
            success: function(response) {

                if (response.status == 'success') {
                    console.log(response.message);
                    // Perbarui total belanja
                    $('#total').text(formatRupiah(response.total));
                }
                else if (response.status == 'fail') {
                    Swal.fire({
                        icon: "error",
                        title: "INFO",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    window.location.href = "{{ route('cart.index') }}";
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function changeQty(key, val) {

        if (val === "") {
            console.log("Quantity is empty");
            window.location.href = "{{ route('cart.index') }}";
        }

        // Cek apakah quantity adalah angka
        const qty = parseInt(val);
        if (isNaN(qty) || qty < 0) {
            console.log("Invalid quantity");
            window.location.href = "{{ route('cart.index') }}";
        }

        // Ajax update qty
        updateCart(key, val);
    }

    function formatRupiah(number) {
        return parseFloat(number).toLocaleString('id-ID', {
            maximumFractionDigits: 3
        });
    }
</script>
@endsection