<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <style>
        input[type="radio"] {
            display: none;
        }

        .pttt {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pttt:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="radio"]:checked + .pttt {
            background-color: #007BFF !important;
            color: white;
            border-color: #007BFF;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }
    </style>
   
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="http://127.0.0.1:8000" class="text-body"><i class="fas fa-long-arrow-alt-left me-2" href="http://127.0.0.1:8000/home"></i>Continue shopping</a></h5>
                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Shopping cart</p>
                                            <p class="mb-0">You have {{$countcart}} items in your cart</p>
                                        </div>
                                        <div>
                                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i class="fas fa-angle-down mt-1"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                    @php
                                    $totalprice =0;
                                    @endphp
                                    @foreach($carts as $cart)
                                    @php
                                    $totalprice += $cart->product->price * $cart->quantity;
                                    @endphp
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="{{ asset('images') }}/{{$cart->product->slide_url}}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>{{$cart->product->title}}</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 120px;">
                                                        <h5 class="fw-normal mb-0">{{number_format($cart->product->price)}}</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 50px;">
                                                        <h5 class="fw-normal mb-0">{{$cart->quantity}}</h5>
                                                    </div>
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0"></h5>
                                                    </div>
                                                    <form action="{{ route('delete-cart',[$cart->product->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" style="color: #cecece;" class="btn fas fa-trash-alt"></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-5">
                                    <form action="{{route('checkout')}}" method="post">
                                        @csrf
                                        <div class="card bg-primary text-white rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5 class="mb-0">Card details</h5>
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                                </div>
                                                <p class="small mb-2">Card type</p>
                                                <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                                <form class="mt-4">
                                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Name" name="name" value="{{$auths->name}}" />
                                                        <label class="form-label" for="typeName">Name</label>
                                                    </div>
                                                    <div class="form-outline form-white mb-4">
                                                        <input type="text" id="typeText" class="form-control form-control-lg" name="address" placeholder="Address" value="" />
                                                        <label class="form-label" for="typeText">Address</label>
                                                        <div>
                                                            <label class="form-label" for="typeText">Phương thức thanh toán </label>
                                                            <div class="d-flex">
                                                                <div>
                                                                    <input type="radio" name="value_payment" id="tttm" value="tttm">
                                                                    <label for="tttm" class="pttt">Thanh toán khi nhận hàng</label>
                                                                </div>
                                                                <div>
                                                                    <input type="radio" name="value_payment" id="ttonl" value="ttonl">
                                                                    <label for="ttonl" class="pttt">Thanh toán trực tuyến</label>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </form>
                                                <hr class="my-4">
                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Subtotal</p>
                                                    <p class="mb-2">{{$totalprice}} VND</p>
                                                </div>
                                                <button type="submit" class="btn btn-info btn-block btn-lg">
                                                    <input type="hidden" name="total" value="{{$totalprice}}">
                                                    <input type="hidden" name="redirect">
                                                    <div class="d-flex justify-content-between">
                                                        <span>{{number_format($totalprice)}} VND</span>
                                                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
