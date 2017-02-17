<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>@lang('general.TheNerdBook')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @yield('styles')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="{{ asset('/js/layout.js') }}"></script>
    @yield('script_header')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

@yield('navbar')

<div class="container">
    <div class="row row-offcanvas row-offcanvas-left" >
        <div class="clearfix col-xs-12 col-sm-3 sidebar-offcanvas collapse active" id="sidebar" role="navigation">
            <ul  class="nav">

            </ul>
        </div>

        <div class="container col-xs-12 col-sm-9" id="contenu_page">
            @yield('content')
        </div>
    </div>
</div>
</body>

</html>