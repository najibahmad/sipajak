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

    <div class="row">
      <div class="col-lg-12"><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Grup</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>
                  <form class="{{URL('admin/rekening/editRekening')}}" action="index.html" method="post">
                      <button type="submit" name="button" class="btn btn-warning">Reset</button>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>

  </div>
@endsection
