<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Control Panel</title>

    <link rel="icon" type="image/gif" sizes="32x32" href="{{url($default_url.'icon-controlPanel.png')}}">

    <!-- Morris Charts CSS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- Datejs -->
    <script src="https://storage.googleapis.com/google-code-archive-downloads/v2/code.google.com/datejs/date.js"></script>

    <!-- Bootstrap datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- w3 css -->
    <link rel="stylesheet" type="text/css" href="{{URL($default_url.'css/w3.css')}}">

    <!-- Custom CSS -->
    <link href="{{URL($default_url.'css/sb-admin.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL($default_url.'font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Jquery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <!-- JQuery JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        html, body{
         width:100%;
         height:100%;
         background-color:#fff;
       font-family: 'Sansita', sans-serif;
         }
        .vcenter{
            display: inline-block;
            vertical-align: middle;
            float: none;
        }
    </style>
    @yield('css')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL('/admin')}}">Dashboard Administrator</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i> Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li @yield('dashboard-active')>
                        <a href="{{url('admin')}}"><i class="fa fa-fw fa-dashboard"></i> Beranda</a>
                    </li>
                    <li @yield('rekening-active')>
                        <a href="{{url('admin/rekening')}}"><i class="fa fa-fw fa-bar-chart-o"></i> Rekening Penerimaan</a>
                    </li>
                    <li @yield('tarif-active')>
                        <a href="{{url('admin/tarif')}}"><i class="fa fa-fw fa-align-left"></i> Standar Tarif</a>
                    </li>
                    <li @yield('pajak-active')>
                        <a href="{{url('admin/pajak')}}"><i class="fa fa-fw fa-book"></i> Jenis Pajak</a>
                    </li>
                    <li @yield('pwd-active')>
                        <a href="{{url('admin/pwd')}}"><i class="fa fa-fw fa-key"></i> Ubah Password</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- JQuery UI -->
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    @yield('script')
</body>

</html>
