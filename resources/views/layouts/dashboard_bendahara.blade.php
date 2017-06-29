<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Bendahara</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL($default_url.'css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL($default_url.'metisMenu/metisMenu.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL($default_url.'css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{URL($default_url.'css/table.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL($default_url.'font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
      html, body{
       width:100%;
       height:100%;
       background-color:#fff;
     font-family: 'Sansita', sans-serif;
       }
    </style>
    @yield('css')
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
                <a class="navbar-brand" href="index.html">Dashboard Bendahara</a>
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
                        <li @yield('dashboard')>
                            <a href="{{url('bendahara')}}" @yield('dashboard')><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li @yield('dataPajak')>
                            <a href="{{url('bendahara/dataPajak')}}" @yield('dataPajak')><i class="fa fa-table fa-fw"></i> Data Pajak</a>
                        </li>
                        <li @yield('laporan')>
                            <a href="{{url('bendahara/laporan')}}" @yield('laporan')><i class="fa fa-list-alt fa-fw"></i> Laporan Pembayaran Pajak</a>
                        </li>
                        <li @yield('laporan_setoran')>
                            <a href="{{url('bendahara/laporan_setoran')}}" @yield('laporan_setoran')><i class="fa fa-list-alt fa-fw"></i> Laporan Setoran Bank</a>
                        </li>
                        <li @yield('pwd')>
                            <a href="{{url('bendahara/pwd')}}" @yield('pwd')><i class="fa fa-key fa-fw"></i> Reset Password</a>
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

    <script>


$(document).ready(function() {

    var table = $('#table');


    // Table striped
    $('#table-striped').change(function() {
        var value = $( this ).val();
        table.removeClass('table-striped').addClass(value);
    });

    // Table hover
    $('#table-hover').change(function() {
        var value = $( this ).val();
        table.removeClass('table-hover').addClass(value);
    });

    // Table color
    $('#table-color').change(function() {
        var value = $(this).val();
        table.removeClass(/^table-mc-/).addClass(value);
    });
});

// jQuery’s hasClass and removeClass on steroids
// by Nikita Vasilyev
// https://github.com/NV/jquery-regexp-classes
(function(removeClass) {

	jQuery.fn.removeClass = function( value ) {
		if ( value && typeof value.test === "function" ) {
			for ( var i = 0, l = this.length; i < l; i++ ) {
				var elem = this[i];
				if ( elem.nodeType === 1 && elem.className ) {
					var classNames = elem.className.split( /\s+/ );

					for ( var n = classNames.length; n--; ) {
						if ( value.test(classNames[n]) ) {
							classNames.splice(n, 1);
						}
					}
					elem.className = jQuery.trim( classNames.join(" ") );
				}
			}
		} else {
			removeClass.call(this, value);
		}
		return this;
	}

})(jQuery.fn.removeClass);
    </script>

    @yield('script')

</body>

</html>
