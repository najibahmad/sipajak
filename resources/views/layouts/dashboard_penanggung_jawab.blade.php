<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Penanggung Jawab</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL($default_url.'css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL($default_url.'metisMenu/metisMenu.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL($default_url.'css/sb-admin-2.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Custom Fonts -->
    <link href="{{URL($default_url.'font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <style media="screen">
      html, body{
       width:100%;
       height:100%;
       background-color:#fff;
     font-family: 'Sansita', sans-serif;
       }
    .carousel-inner,.carousel,.item,.container,.fill {
     height:100%;
     width:100%;
     background-position:center center;
     background-size:cover;
    }
    .slide-wrapper{display:inline;}
    .slide-wrapper .container{padding:0px;}

    /*------------------------------ vertical bootstrap slider----------------------------*/

    .carousel-inner> .item.next ,  .carousel-inner > .item.active.right{ transform: translateY(100%); -webkit-transform: translateY(100%); -ms-transform: translateY(100%);
    -moz-transform: translateY(100%); -o-transform: translateY(100%);  top: 0;left:0;}
    .carousel-inner > .item.prev ,.carousel-inner > .item.active.left{ transform: translateY(-100%); -webkit-transform: translateY(-100%);  -moz-transform: translateY(-100%);
    -ms-transform: translateY(-100%); -o-transform: translateY(-100%); top: 0; left:0;}
    .carousel-inner > .item.next.left , .carousel-inner > .item.prev.right , .carousel-inner > .item.active{transform:translateY(0); -webkit-transform:translateY(0);
    -ms-transform:translateY(0);-moz-transform:translateY(0); -o-transform:translateY(0); top:0; left:0;}

    /*------------------------------- vertical carousel indicators ------------------------------*/
    .carousel-indicators{
    position:absolute;
    top:0;
    bottom:0;
    margin:auto;
    height:20px;
    right:10px; left:auto;
    width:auto;
    }
    .carousel-indicators li{display:block; margin-bottom:5px; border:1px solid #00a199; }
    .carousel-indicators li.active{margin-bottom:5px; background:#00a199;}
    /*-------- Animation slider ------*/

    .animated{
     animation-duration:3s;
     -webkit-animation-duration:3s;
     -moz-animation-duration:3s;
     -ms-animation-duration:3s;
     -o-animation-duration:3s;
     visibility:visible;
     opacity:1;
     transition:all 0.3s ease;
    }
    .carousel-img{
      display: inline-block;
       margin: 0 auto;
       width: 100%;
       text-align: center;
     }
    .item img{margin:auto;visibility:hidden; opacity:0; transition:all 0.3s ease; -webkit-transition:all 0.3s ease; -moz-transition:all 0.3s ease; -ms-transition:all 0.3s ease; -o-transition:all 0.3s ease;}
    .item1 .carousel-img img , .item1.active .carousel-img img{max-height:300px;}
    .item1.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 1s ease; -webkit-transition:all 1s ease; -moz-transition:all 1s ease; -ms-transition:all 1s ease; -o-transition:all 1s ease;
    animation-duration:2s; -webkit-animation-duration:2s; -moz-animation-duration:2s; -ms-animation-duration:2s; -o-animation-duration:2s; animation-delay:0.3s ; -webkit-animation-delay:0.3s;
    -moz-animation-delay:0.3s;-ms-animation-delay:0.3s; }
    .item .carousel-desc{color:#fff; text-align:center;}
    .item  h2{font-size:50px; animation-delay:1.5s;animation-duration:1s; }
    .item  p{animation-delay:2.5s;animation-duration:1s; width:50%; margin:auto;}

    .item2 .carousel-img img , .item2.active .carousel-img img{max-height:300px;}
    .item2.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 0.3s ease; animation-duration:3s; animation-delay:0.3s}
    .item2 h2 , item2.active h2{visibility:hidden; opacity:0; transition:all 5s ease;}
    .item2.active h2.animated{visibility:visible; opacity:1;  animation-delay:3s;}

    .item .fill{padding:0px 30px; display:table; }
    .item .inner-content{display: table-cell;vertical-align: middle;}
    .item3 .col-md-6{float:none; display:inline-block; vertical-align:middle; width:49%;}

    .item3.active .carousel-img img.animated{visibility:visible; opacity:1; transition:all 0.3s ease; animation-duration:2s; animation-delay:0.3s}
    .item3 h2 , item3.active h2{visibility:hidden; opacity:0; transition:all 5s ease; }
    .item.item3 .carousel-desc{text-align:left;}
    .item3.active h2.animated{visibility:visible; opacity:1;  animation-delay:1.5s}
    .item3 p , item3.active p{visibility:hidden; opacity:0; transition:all 5s ease; width:100%;  }
    .item3.active p.animated{visibility:visible; opacity:1;  animation-delay:2.5s;}

    @media(max-width:991px)
    {
     .item .carousel-desc , .item.item3 .carousel-desc{text-align:center;}
     .item .carousel-desc p {width:80%;}
     .item3 .col-md-6{width:100%; text-align:center;}
    }
    @media(max-width:768px)
    {
    .item .carousel-img img, .item.active .carousel-img img{max-height:155px;}
    .item  h2{font-size:30px; margin-top:0px;}
    .item .carousel-desc p{width:100%; font-size:12px;}
    }
    @media(max-width:480px)
    {
    .item  h2{font-size:30px;}
    .item .carousel-desc p{width:100%;}
    }
    </style>
    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Dashboard Penanggung Jawab</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li @yield('dashboard-active')>
                            <a href="{{URL('/penanggungJawab')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li @yield('pegawai-active')>
                            <a href="{{URL('/penanggungJawab/pegawai')}}"><i class="fa fa-user fa-fw"></i> Pegawai</a>
                        </li>
                        <li @yield('pwd-active')>
                            <a href="{{URL('/penanggungJawab/pwd')}}"><i class="fa fa-key fa-fw"></i> Ubah Password</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{URL($default_url.'js/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{URL($default_url.'js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{URL($default_url.'metisMenu/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{URL($default_url.'js/sb-admin-2.js')}}"></script>
    @yield('script')

</body>

</html>
