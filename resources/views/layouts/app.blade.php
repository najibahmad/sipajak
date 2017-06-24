<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Perpajakan</title>


    <!-- Styles -->
    <link href="{{ URL($default_url.'css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="http://layakhuni.msd-net.com/assets/css/bootstrap.css" type="text/css" media="all">
  <link href="{{ URL($default_url.'css/styles-login.css') }}" rel="stylesheet">
  <link href="http://layakhuni.msd-net.com/assets/plugins/waitMe/waitMe.min.css" rel="stylesheet" />
  <link href="http://layakhuni.msd-net.com/assets/plugins/jAlert/jAlert.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="http://layakhuni.msd-net.com/assets/img/favicon.png" />
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app" >


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ URL($default_url.'js/app.js') }}"></script>
    @yield('script')
</body>
</html>
