<!DOCTYPE html>
<html>
    <head>
        <title>Portal - @yield('title')</title>
        <link href="/css/img/favicon.png" rel="icon" type="image/x-icon">
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

        <link href="/css/main.css" rel="stylesheet" type="text/css">
        <link href="/css/styles.css" rel="stylesheet" type="text/css">
        <link href="/css/forms.css" rel="stylesheet" type="text/css">
        <link href="/css/components.css" rel="stylesheet" type="text/css">
        <link href="/css/svg.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="sidebar">
            <div class="row">
                <div class="logo">
                    <!--<span><a href="/"><img src="/css/img/logo.png" height="40px"></a></span>-->
                    <span><a href="/"><i class="fa fa-credit-card-alt"></i></a></span>

                </div>
                <nav>
                    <a class="nav-item active" href="/">main</a>
                    <a class="nav-item" href="/bitrix24">bitrix24</a>
                    <a class="nav-item" href="/contur-focus">cfocus</a>
                    <a href="#" id="nav-menu"><i class="fa fa-bars"></i></a>
                </nav>
            </div>
        </div>
        @section('sidebar')
        @show
        <div class="container">
            @yield('content')
        </div>
        <div class="footer">
            &copy; Vladimir Bushuev 2015
        </div>
        <div class="overlay"></div>
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="/js/vsb.js"></script>
        @yield('scripts')
    </body>
</html>
