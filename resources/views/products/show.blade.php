@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 100%">
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <h3>{{ $product->title }}</h3>
                <hr/>
                <p>{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                <code>
                    <p>{!! $product->description !!}</p>
                </code>
                <hr/>
                <p>Qty : <input type="number" class="form-control qtyItemOnDetail" value="1" min="1" style="width: 100px;"></p>
            </div>
        </div>
        <div class="d-flex flex-row mt-2">
            <button type="button" class="btn btn-primary addToCart" id="<?php echo base64_encode($product->id); ?>">
                <i class="fa fa-shopping-cart"></i> Add To Cart
            </button>
            <button type="button" class="btn btn-danger addToCartAndGoingToCart" id="<?php echo base64_encode($product->id); ?>">
                <a href="{{ route('cart.index') }}" class="btn btn-danger">
                    Order Now
                </a>
            </button>
        </div>
    </div>
</div>

<script>

    $('.addToCartAndGoingToCart').on('click', function (e) {

        e.preventDefault();

        let theKey = this.id;
        let quantity = $('.qtyItemOnDetail').val();

        $.ajax({
            url: '/cart',
            method: 'POST',
            data: {
                keyID: theKey,
                qty: quantity,
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            success: function (response) {
                console.log(response.message);
                // redirect
                window.location.href = "{{ route('cart.index') }}";
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    //message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>

@endsection