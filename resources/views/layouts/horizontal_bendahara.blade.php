<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>BENDAHARA PERPAJAKAN</title>
    <!-- Bootstrap Core CSS -->
    <!-- Morris Charts CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="{{url($default_url.'css/bootstrap-datepicker.min.css')}}">

    <!-- Bootstrap datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- JQueryUI CSS -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- w3 css -->
    <link rel="stylesheet" type="text/css" href="{{URL($default_url.'css/w3.css')}}">

    <!-- Custom Fonts -->
    <link href="{{URL($default_url.'font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Jquery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <!-- CUSTOM STYLE  -->
    <link href="{{url('css/style.css')}}" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    @yield('css')
</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">

                    <img src="{{url('img/logo.png')}}" />
                </a>

            </div>

            <div class="right-div">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-info pull-right">LOG ME OUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="{{url('bendahara')}}" >DASHBOARD</a></li>
                            <li><a href="{{url('bendahara/dataPajak')}}">DATA PAJAK</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">LAPORAN <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('bendahara/laporan')}}">LAPORAN PEMBAYARAN PAJAK</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('bendahara/laporan_setoran')}}">LAPORAN SETORAN BANK</a></li>

                                </ul>
                            </li>
                            
                            <li><a href="{{url('bendahara/pwd')}}">PASSWORD</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
     <!-- MENU SECTION END-->
    <div class="content-wrapper">
       @yield('content')
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; 2017 Sistem Informasi Pajak | Dinas Pendapatan, Pengelolaan Keuangan dan Aset Kabupaten Kerinci
                </div>

            </div>
        </div>
    </section>
      <!-- FOOTER SECTION END-->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
      <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <!-- JQuery UI -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

      <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
      <script src="{{url($default_url.'js/bootstrap-datepicker.js')}}" charset="utf-8"></script>
      <script src="{{url($default_url.'locales/bootstrap-datepicker.id.min.js')}}" charset="utf-8"></script>
      <script>
          $(document).ready(function(){
            $('.datepicker').datepicker({
                language: 'id',
                format:'yyyy-mm-dd'
            });
          });
      </script>

      <!-- Metis Menu Plugin JavaScript -->
      <script src="{{URL($default_url.'metisMenu/metisMenu.min.js')}}"></script>
        <!-- CUSTOM SCRIPTS  -->
      <script src="{{url('js/custom.js')}}"></script>
    @yield('script')
</body>
</html>
