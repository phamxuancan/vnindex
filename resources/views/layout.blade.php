<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('display-vnindex')}}">HOME</a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="#">Link 1</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link 2</a>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Dropdown link
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Link 1</a>
                <a class="dropdown-item" href="#">Link 2</a>
                <a class="dropdown-item" href="#">Link 3</a>
            </div>
            </li>
        </ul>
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    </body>
    <script src="{{ URL::asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }}" ></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</html>