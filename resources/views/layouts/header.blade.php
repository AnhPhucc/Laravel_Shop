<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Navbar and Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #343a40; /* Dark background color */
        }
        .navbar {
            background-color: #000; /* Darker navbar background */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        .navbar-brand, .nav-link, .dropdown-item {
            color: #fff !important; /* White text color */
        }
        .navbar-brand:hover, .nav-link:hover, .dropdown-item:hover {
            color: #ffc107 !important; /* Yellow text color on hover */
        }
        .navbar-toggler-icon {
            color: #ffc720;
        }
        header {
            background-color: #000; /* Darker header background */
            color: #fff; /* White text color */
            padding: 0; /* Remove padding to fit carousel */
        }
        .carousel-item {
            height: 400px; /* Adjust the height as needed */
            background-size: cover;
            background-position: center;
        }
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for text */
            padding: 1rem;
        }
        .btn-outline-black {
            color: #fff; /* White button text color */
            border-color: #fff; /* White button border color */
        }
        .btn-outline-black:hover {
            background-color: #fff; /* White background color on hover */
            color: #000; /* Black text color on hover */
        }
        .badge {
            background-color: #ffc107; /* Yellow badge background color */
            color: #343a40; /* Dark badge text color */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand text-bold text-uppercase text-white" href="http://127.0.0.1:8000">Laravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span> <!-- Changed the color to white -->
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Quản lý danh mục</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('categories.create') }}">Thêm danh mục</a></li>
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">Chỉnh sửa danh mục</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Quản lý sản phẩm</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('products.create') }}">Thêm sản phẩm</a></li>
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">Chỉnh sửa sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <a class="dropdown-item" href="{{ route('user') }}">{{ __('My Account') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                @endguest
            </ul>
            <form class="d-flex">
                <a class="btn btn-warning" href="http://127.0.0.1:8000/cart"> <!-- Changed button color to yellow -->
                    <i class="fas fa-shopping-cart"></i>
                    <span class="ms-1">Cart</span>
                    <span class="badge bg-dark text-white ms-1 rounded-pill">{{$countcartshare}}</span>
                </a>
            </form>
        </div>
    </div>
</nav>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
