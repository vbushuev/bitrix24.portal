<!DOCTYPE html>
<html>
    <head>
        <title>Portal - @yield('title')</title>
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/main.css" rel="stylesheet" type="text/css">
        <link href="/css/styles.css" rel="stylesheet" type="text/css">
        <link href="/css/forms.css" rel="stylesheet" type="text/css">
        <link href="/css/components.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show
        <div class="container">
            @yield('content')
        </div>
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        @yield('scripts')
    </body>
</html>
