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
    </head>
    <body>
        <div class="sidebar">
            @section('sidebar')
                <div class="row">
                    <div class="logo">
                        <span>#logo place</span>
                    </div>
                    <ul class="nav">
                        <li><a class="active" href="/">main</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="/bitrix24">bitrix24</a></li>
                        <li><a href="/contur-focus">cfocus</a></li>
                        <li><a href="#">contacts</a></li>
                        <li class="last"><i class="fa fa-bars clickable"></i></li>
                    </ul>
                </div>
                <div class="row">
                    <nav>
                        <a class="active" href="/">main</a>
                        <a href="/bitrix24">bitrix24</a>
                        <a href="/contur-focus">cfocus</a>
                    </nav>
                </div>
            @show
        </div>
        <div class="container">
            @yield('content')
        </div>
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="/js/vsb.js"></script>
        @yield('scripts')
    </body>
</html>
