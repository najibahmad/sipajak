@extends('layouts/dashboard_admin')
@section('title','Control Panel')
@section('pwd-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Reset Password Pegawai
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <form class="" action="{{url('admin/pwd/updatePwd')}}" method="post">
      <div class="form-group">
        <label for="">Ganti Password Akun Anda</label>
        <input type="password" class="form-control" name="pwd" value="">
      </div>
      <button type="submit" class="btn btn-success btn-block" name="button">Submit</button>
    </form>

  </div>
@endsection
