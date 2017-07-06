@extends('layouts/horizontal_operator')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Change Password
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <form class="" action="{{url('operator/pwd/updatePwd')}}" method="post">
      <div class="form-group">
        <label for="">Ganti Password Akun Anda</label>
        <input type="password" class="form-control" name="pwd" value="">
      </div>
      <button type="submit" class="btn btn-success" name="button">Submit</button>
    </form>

  </div>
@endsection
