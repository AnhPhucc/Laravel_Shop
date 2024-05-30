@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Danh sách sản phẩm</div>
              
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @foreach($categories as $category)
                                @foreach($products->where('category_id', $category->id) as $product)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td><img width="250" src="{{ asset('images') }}/{{$product->slide_url}}" alt=""></td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            <a href="{{route('products.edit', [$product->id])}}" class="btn btn-primary">Sửa</a>
                                            <form action="{{route('products.destroy', [$product->id])}}" method="POST">
                                                @method("DELETE")
                                                @csrf
                                                <button class="btn btn-danger custom-btn"
                                                    onclick="return confirm('Bạn muốn xoá danh mục này?');">Xoá</button>

                                            </form>

                                        </td>
                                    </tr>
                                    <style>
                                    </style>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection