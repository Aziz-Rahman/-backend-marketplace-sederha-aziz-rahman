<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* CART */
        #cartCount {
            transition: transform 0.2s ease-in-out;
        }

        #cartCount.updated {
            transform: scale(1.5);
        }

        #cartCount.updated-end {
            transform: scale(1);
        }
        /* END: CART */
    </style>
</head>
<body style="background: lightgray">

    @include('layouts.navtop')

    <div class="container mt-5">
        @yield('content')
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {

        loadCartItems();

        updateCartCount();

        $(".shopping-cart").hide();

        $('.addToCart').on('click', function (e) {

            e.preventDefault();

            let theKey = this.id;
            let quantity;

            @if (Route::has('products.show') && request()->routeIs('products.show'))
                quantity = $('.qtyItemOnDetail').val();
            @else
                quantity = 1;
            @endif

            $.ajax({
                url: '/cart',
                method: 'POST',
                data: {
                    keyID: theKey,
                    qty: quantity,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function (response) {

                    if (response.status == 'fail') {
                        Swal.fire({
                            icon: "error",
                            title: "INFO",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }

                    console.log(response.message);
                    updateCartCount();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });

    function updateCartCount() {
        $.ajax({
            url: '/cartCount',
            method: 'GET',
            success: function(response) {
                $('#cartCount').text(response.count);

                // Tambahkan animasi
                $('#cartCount').addClass('updated');

                setTimeout(function() {
                    $('#cartCount').removeClass('updated');
                }, 200); // Reset animasi setelah 200ms
            },
            error: function(error) {
                console.error('Error fetching cart count:', error);
            }
        });
    }

    $("#cart").on("click", function() {
        $('.shopping-cart').slideToggle(400, function() {
            // Callback setelah slideToggle selesai
            if ($(this).is(':visible')) {
                loadCartItems();
            }
        });
    });

    // Function to load cart items
    function loadCartItems() {
        $.ajax({
            url: '/cartItems',
            method: 'GET',
            success: function (response) {
                var cartItems = response.cartItems;

                if (cartItems.length > 0) {
                    var html = '';

                    cartItems.forEach(function (item) {
                        html += `
                            <ul class="shopping-cart-items cartItem">
                                <li class="clearfix">
                                    <img src="/storage/products/${item.product.image}" alt="${item.product.title}" width="70px">
                                    <span class="item-name"><strong>${item.product.title}</strong></span>
                                    <span class="item-price">${item.price}</span>
                                    <span class="item-quantity">${item.quantity}</span>
                                </li>
                            </ul>
                        `;
                    });

                    $('#cartItems').html(html);
                } else {
                    $('#cartItems').html('<p>Your cart is empty.</p>');
                }
            },
            error: function (error) {
                console.error('Error fetching cart items:', error);
            }
        });
    }

    //message with sweetalert
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
    </script>
    
</body>
</html>
