@extends('layouts.app')

@section('content')

<div class="banner">

<div class="agileinfo-dot" style="
    background: background-size:cover;
    background-color: lightseagreen;
    ">

	<div class="container" style="margin-top:50px;">
	<div class="pull-left">
		<img src="{{asset('images/logo2.png')}}" width="100" class="img-responsive">
		<span class=" font-small">Kabupaten Kerinci</span>
	</div>

  <div class="pull-right">
		<img src="{{asset('img/logo.png')}}" width="200" class="img-responsive">
		<span class=" font-small">Kabupaten Kerinci</span>
	</div>




	<div class="w3layoutscontaineragileits" style="margin-top:70px;">
	<h2>LOGIN</h2>
  <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
			<input type="text" Name="email" placeholder="EMAIL USER" required="" class="text" id="email" >
      @if ($errors->has('email'))
          <span class="help-block">
              <strong  style="color:red;">{{ $errors->first('email') }}</strong>
          </span>
      @endif
			<input type="password" Name="password" placeholder="PASSWORD" required="" class="password" id="password">
      @if ($errors->has('password'))
          <span class="help-block">
              <strong  style="color:red;">{{ $errors->first('password') }}</strong>
          </span>
      @endif

			<div class="aitssendbuttonw3ls">

				<input type="submit" class="submit" value="MASUK">



				<div class="clear"></div>
			</div>
		</form>
	</div>



	<div class="w3footeragile">
    <span class=" font-big">&copy; 2017 Sistem Informasi Pajak | Badan Pengelola Pajak dan Retribusi Daerah Kabupaten Kerinci</span>
		<p class="blue"> </p>
	</div>
	</div>
</div>
</div>




@section('script')
<script src="http://layakhuni.msd-net.com/assets/js/jquery.min.js"></script>
	<script src="http://layakhuni.msd-net.com/assets/js/bootstrap.js"></script>
	<script src="http://layakhuni.msd-net.com/assets/plugins/form-validation/jquery.form-validator.min.js"></script>
	<script src="http://layakhuni.msd-net.com/assets/plugins/waitMe/waitMe.min.js"></script>
	<script src="http://layakhuni.msd-net.com/assets/plugins/jAlert/jAlert.min.js"></script>
	<script src="http://layakhuni.msd-net.com/assets/plugins/jAlert/jAlert-functions.min.js"></script>


	<script src="http://layakhuni.msd-net.com/assets/js/custom1.js"></script>

@endsection
