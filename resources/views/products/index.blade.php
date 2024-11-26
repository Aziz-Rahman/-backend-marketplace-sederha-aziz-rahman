@extends('layouts.app')

@section('content')

<?php
// session_start();
// session_destroy();
// print_r($sessionId);
?>

<div class="row">
    {{-- <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 150px">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Products belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div> --}}

    <br>

    @forelse ($products as $product)
        <div class="col-md-3 mt-5 mb-5">
            <div class="card">
                <div class="image-container">
                    <img src="{{ asset('/storage/products/'.$product->image) }}" alt="produk" width="100%">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">
                        {{ "Rp " . number_format($product->price,2,',','.') }}
                    </p>

                    <div class="d-flex flex-row btn-group">
                        <button type="button" class="btn btn-primary addToCart" id="<?php echo base64_encode($product->id); ?>">
                            <i class="fa fa-shopping-cart"></i> Add To Cart
                        </button>
                        {{-- <button type="button" class="btn btn-danger"> --}}
                            <a href="{{ route('products.show', $product->id) }}"  class="btn btn-danger">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                        {{-- </button> --}}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-danger">
            Data Products belum Tersedia.
        </div>
    @endforelse
</div>

<style>
    .image-container {
        width: auto; /* Lebar div */
        height: 300px; /* Tinggi div */
        overflow: hidden; /* Menyembunyikan bagian gambar yang keluar dari div */
        border: 1px solid #ddd; /* Border untuk div */
        margin: 0; /* Margin antar gambar */
        display: inline-block; /* Menampilkan gambar dalam satu baris */
    }

    .image-container img {
        width: 100%; /* Mengatur lebar gambar 100% dari div */
        height: 100%; /* Mengatur tinggi gambar 100% dari div */
        object-fit: cover; /* Memastikan gambar mengisi div tanpa merusak rasio aspek */
    }
</style>

@endsection
