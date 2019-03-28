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
            <a class="nav-link" href="{{ route('display-vnindex',['nnmua' => 5000])}}">NN mua >5000</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('display-vnindex',['nnban' => 5000])}}">NN ban >5000</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sort',['desc' => 1])}}">Mua > ban</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sort',['asc' => 1])}}">Mua < ban</a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Loc Gia
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 1,'to'=>10])}}">From 1->10</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 10,'to'=>20])}}">From 10->20</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 20,'to'=>30])}}">From 20->30</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 30,'to'=>40])}}">From 30->40</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 40,'to'=>50])}}">From 40->50</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 50,'to'=>60])}}">From 50->60</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 60,'to'=>70])}}">From 60->70</a>
                <a class="dropdown-item" href="{{ route('display-vnindex',['from' => 70,'to'=>300])}}">Tren 70</a>
            </div>
            </li>
            <li class="nav-item">
            <form class="form-inline">
                <input class="form-control mr-sm-2" name="code" type="text" placeholder="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            </li>
        </ul>
        </nav>
        <div class="container-fluid">
            @include('elements.error')
            @yield('content')
        </div>
    </body>
    <script src="{{ URL::asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }}" ></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</html>