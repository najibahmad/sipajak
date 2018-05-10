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
    <title>VERIFIKATOR</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{URL($default_url.'css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL($default_url.'metisMenu/metisMenu.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL($default_url.'css/sb-admin-2.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- DATATABLE STYLE  -->
    <link href="{{url($default_url.'js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />

    <!-- Custom Fonts -->
    <link href="{{URL($default_url.'font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

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
                            <li><a href="{{url('verifikator')}}" >DASHBOARD</a></li>
                            <li><a href="{{url('verifikator/verifikasiKetetapanPajak')}}">VERIFIKASI DATA KETETAPAN PAJAK</a></li>

                            <!-- OPERATOR -->
                            <li><a href="{{url('verifikator/wajibPajak')}}">WAJIB PAJAK</a></li>
                            <li><a href="{{url('verifikator/ketetapanPajak')}}">KETETAPAN PAJAK</a></li>
                            <!-- OPERATOR -->

                            <!-- BENDAHARA -->
                            <li><a href="{{url('verifikator/dataPajak')}}">DATA PAJAK</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">LAPORAN <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('verifikator/laporan')}}">LAPORAN PEMBAYARAN PAJAK</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('verifikator/laporan_setoran')}}">LAPORAN SETORAN BANK</a></li>

                                </ul>
                            </li>
                            <!-- BENDAHARA -->


                            <li><a href="{{url('verifikator/pwd')}}">PASSWORD</a></li>
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
                   &copy; 2017 Sistem Informasi Pajak | Badan Pengelola Pajak dan Retribusi Daerah Kabupaten Kerinci
                </div>

            </div>
        </div>
    </section>
      <!-- FOOTER SECTION END-->
    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL($default_url.'js/bootstrap.min.js')}}"></script>
    <script src="{{url($default_url.'js/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{url($default_url.'js/dataTables/dataTables.bootstrap.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL($default_url.'metisMenu/metisMenu.min.js')}}"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="{{url('js/custom.js')}}"></script>
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
    @yield('script')
</body>
</html>
