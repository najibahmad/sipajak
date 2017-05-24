@extends('layouts/dashboard_bendahara')
@section('content')
  <div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Beranda
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <form class="" action="{{url('bendahara/pwd/updatePwd')}}" method="post">
      <div class="form-group">
        <label for="">Ganti Password Akun Anda</label>
        <input type="password" class="form-control" name="pwd" value="">
      </div>
      <button type="submit" class="btn btn-success btn-block" name="button">Submit</button>
    </form>

  </div>
@endsection
