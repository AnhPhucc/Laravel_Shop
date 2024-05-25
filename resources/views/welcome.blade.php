@extends('layouts.app')

@section('content')
@if (session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-5 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                <a href="{{ route('products.Detail',[$product->id]) }}" class="text-decoration-none">
                    <div class="card h-100 shadow border-0 rounded-lg overflow-hidden">
                        <div class="position-relative">
                            <img class="card-img-top img-fluid" src="{{ asset('images') }}/{{$product->slide_url}}" alt="Product image">
                            <div class="badge bg-primary position-absolute top-0 start-0 m-2 p-2 text-white rounded-pill" style="font-size: 0.8em; font-weight: 700;">New Arrival</div>
                        </div>
                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bold text-primary mb-3">{{ $product->title }}</h5>
                            <p class="text-muted">{{ $product->price }}.000VNĐ</p>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                            <form action="{{ route('addtocart',[$product->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="qty" value="1">
                                <button class="btn btn-primary btn-sm rounded-pill" type="submit">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection