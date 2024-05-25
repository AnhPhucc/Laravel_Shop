@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2>{{ $product->title }}</h2>
                </div>
                <div class="card-body">
                    <img class="img-fluid rounded mb-4 shadow-sm" width="250px" src="{{ asset('images') }}/{{ $product->slide_url }}" alt="{{ $product->title }}">
                    <h5 class="fw-bold text-primary mb-3">{{ $product->title }}</h5>
                    <p class="card-text"><strong>Giá: </strong>{{ number_format($product->price, 0, ',', '.') }} .000VNĐ</p>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                        <form action="{{ route('addtocart', [$product->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button class="btn btn-primary btn-lg btn-block mt-auto" type="submit">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Quay lại sản phẩm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
