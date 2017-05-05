@extends('layouts/dashboard_admin')
@section('title','Control Panel')
@section('pajak-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Jenis Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List Jenis Pajak</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/pajak/tambahJenisPajak')}}" method="post">
          <button type="submit" class="btn btn-default">Tambah Jenis Pajak</button>
        </form><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Jenis Pajak</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>lorem</td>
                <td>ipsum</td>
                <td>
                  <form class="{{URL('admin/rekening/editRekening')}}" action="index.html" method="post">
                      <button type="submit" name="button" class="btn btn-warning">Edit</button>
                  </form>
                  <form class="{{URL('admin/rekening/hapusRekening')}}" action="index.html" method="post">
                      <button type="submit" name="button" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>
@endsection
