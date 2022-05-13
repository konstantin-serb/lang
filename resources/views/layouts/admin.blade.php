
    <!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    @stack('top')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top" style="opacity: 100%">
        <div class="container">
            <a class="navbar-brand" href="/admin">
                AdminPanel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user') }}">
                            Users
                        </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            На сайт
                        </a>
                    </li>
                    @guest

                    @else


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div style="margin-top: 3.5em;">
            @yield('content')
        </div>

    </main>
</div>


<footer class="mt-4 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h5><a class="navbar-brand link" href="/admin">
                        AdminPanel
                    </a></h5>
                <ul class="nav flex-column">
                    @auth
                        <li class="nav-item mb-2 text-muted">
                            <a class="nav-link p-0 text-muted"
                               href="#">Users</a>
                        </li>
                    @endauth

                </ul>
            </div>

            <div class="col-2">

            </div>

            <div class="col-2">

            </div>

        </div>

        <div class="d-flex justify-content-between py-4 my-4 border-top" style="margin-bottom: 0 !important;">
            <p>&copy; <?php echo date('Y', time());?>
                <a href="https://i-des.net" class="link">
                    i-des.net
                </a>
            </p>
        </div>
    </div>
</footer>
@stack('bottom')


</body>
</html>
