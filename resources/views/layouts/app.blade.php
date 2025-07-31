<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraKart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('app.products') }}">LaraKart</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">🛒 Cart</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="#">{{ auth()->user()->name }}</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('app.orders') }}">Orders</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @stack('scripts')
</body>

</html>
